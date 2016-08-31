<?php

	class GudangController extends KController

	{

		public function actionIndex()
		{

			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("1", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

				$page = !empty($_GET['page']) ? $_GET['page'] : 1;

				$gudang = Gudang::model()->findAllByAttributes(array('status'=>0));

				$count_petani = count($gudang);
				$limit = 10;
				$gudang_count = ceil($count_petani/$limit);
				$offset = $limit*($page-1);

				$dataProvider = new CActiveDataProvider('Gudang', array(
					'countCriteria' => array(
						'condition' => 'status=0'
					),
					'criteria'      => array(
						'condition' => 'status=0',
						'order'     => 'id_gudang ASC',
					),
					'pagination' => array(
						'pageSize' => 10,
						'pageVar' => 'page',
						'route' => $this->createUrl('/kospermindo/gudang')
					)
				));

				$jenisGudang = JenisGudang::model()->findAll();

				$this->render('index', array(
					'data'         => $dataProvider,
					'jenis_gudang' => $jenisGudang,
				));
			}else{
				$this->redirect('/kospermindo');
			}
		}

		public function actionGetprov()
		{
			$prov = Provinsi::model()->findAll();
			$provinsi = array();

			foreach ($prov as $key => $value) {
				$arr = array('id' => $value->provinsi_id, 'nama' => $value->provinsi_nama);
				array_push($provinsi, $arr);
			};

			echo CJSON::encode($provinsi);
			Yii::app()->end();
		}

		public function actionGetkota()
		{
			$prov = !empty($_POST['prov']) ? $_POST['prov'] : '';
			$getKota = Kotakab::model()->findAllByAttributes(array('provinsi_id' => $prov));
			$kota = array();

			foreach ($getKota as $key => $value) {
				$arr = array('id' => $value->kota_id, 'nama' => $value->kokab_nama);
				array_push($kota, $arr);
			};
			echo CJSON::encode($kota);

		}

		public function actionTambah()
		{
			$jenis_gudang = !empty($_POST['jenis_gudang']) ? $_POST['jenis_gudang'] : '';
			$nama_gudang = !empty($_POST['nama_gudang']) ? $_POST['nama_gudang'] : '';
			$tel = !empty($_POST['telp']) ? $_POST['telp'] : '';
			$luas_gudang = !empty($_POST['luas_gudang']) ? $_POST['luas_gudang'] : '';
			$alamat = !empty($_POST['alamat']) ? $_POST['alamat'] : '';
			$provinsi = !empty($_POST['provinsi']) ? $_POST['provinsi'] : '';
			$kabupaten = !empty($_POST['kabupaten']) ? $_POST['kabupaten'] : '';
			$pj_gudang = !empty($_POST['pj_gudang']) ? $_POST['pj_gudang'] : '';
			$alamatLengkap = $alamat . ", " . $kabupaten . ", " . $provinsi;
			$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($alamatLengkap) . '&sensor=false');
			$geo = json_decode($geo, true);

			if ($geo['status'] = 'OK') {
				$lu = !empty($geo['results'][0]['geometry']['location']['lat']) ? $geo['results'][0]['geometry']['location']['lat'] : '0';
				$ls = !empty($geo['results'][0]['geometry']['location']['lng']) ? $geo['results'][0]['geometry']['location']['lng'] : '0';
			} else {
				$lu = '0';
				$ls = '0';
			}

			$gudang = new Gudang;
			$gudangHistory = new GudangHistory;
			$status = 0;
			$pesan = '';

			$lastkode = Gudang::model()->findAllByAttributes(array('kode_jenis_gudang' => $jenis_gudang),
				array('order' => 'id_gudang DESC', 'limit' => 1));
			if (!$lastkode) {
				$kode = $jenis_gudang . '.001';
			} else {
				$getkode = substr($lastkode[0]['kode_gudang'], (strlen($lastkode[0]['kode_gudang']) - 3),
					(strlen($lastkode[0]['kode_gudang'])));
				$getkodesum = '000' . ((int)$getkode + 1);
				$kode = $jenis_gudang . '.' . substr($getkodesum, (strlen($getkodesum) - 3), strlen($getkodesum));
			}

			$allGudang = Gudang::model()->findAllByAttributes(array('nama'      => $nama_gudang,
																	'alamat'    => $alamat,
																	'kabupaten' => $kabupaten,
																	'provinsi'  => $provinsi,
																	'status'    => 0,
			));
			if (empty($allGudang)) {
				$gudang->kode_gudang = $kode;
				$gudang->kode_jenis_gudang = $jenis_gudang;
				$gudang->nama = $nama_gudang;
				$gudang->alamat = $alamat;
				$gudang->kabupaten = $kabupaten;
				$gudang->provinsi = $provinsi;
				$gudang->latitude = $ls;
				$gudang->longitude = $lu;
				$gudang->luas = $luas_gudang;
				$gudang->telp = $tel;
				$gudang->status = $status;
				$gudang->koordinator = $pj_gudang;
				if ($gudang->save()) {
					$gudangHistory->kode_gudang = $kode;
					$gudangHistory->kode_jenis_gudang = $jenis_gudang;
					$gudangHistory->id_gudang = $gudang->id_gudang;
					$gudangHistory->nama = $gudang->nama;
					$gudangHistory->alamat = $gudang->alamat;
					$gudangHistory->kabupaten = $gudang->kabupaten;
					$gudangHistory->provinsi = $gudang->provinsi;
					$gudangHistory->latitude = $gudang->latitude;
					$gudangHistory->longitude = $gudang->longitude;
					$gudangHistory->luas = $gudang->luas;
					$gudangHistory->telp = $gudang->telp;
					$gudangHistory->status = $gudang->status;
					$gudangHistory->koordinator = $gudang->koordinator;
					$gudangHistory->created_date = date('Y-m-d H:i:s');
					$created_by = Yii::app()->user->id;
					$gudangHistory->created_by = $created_by;
					if ($gudangHistory->save()) {
						Yii::app()->user->setFlash('success', 'Data Gudang berhasil di tambahkan');
						$pesan = array('message' => 'success');
					} else {
						Yii::app()->user->setFlash('failed', 'Data Gudang gagal di tambahkan');
						$pesan = array('message' => 'failed');
					}
				} else {
					Yii::app()->user->setFlash('failed', 'Data Gudang gagal di tambahkan');
					$pesan = array('message' => 'failed');
				}
			} else {
				Yii::app()->user->setFlash('failed', 'Data Gudang tidak boleh sama');
				$pesan = array('message' => 'double');
			}
			echo json_encode($pesan);
		}

		public function actionHapus()
		{

			$req = Yii::app()->request->getIsPostRequest();
			$ajax = Yii::app()->request->getIsAjaxRequest();
			$id = Yii::app()->request->getPost('id');
			$pesan = '';
			$redirectUrl = "/user";
			$status = 1;
			if ($req && $ajax) {
				if ($id) {
					$isGudang = Gudang::model()->findByAttributes(array('id_gudang' => $id));
					$gudangHistory = new GudangHistory;
					if (!empty($isGudang)) {
						$isGudang->status = $status;
						if ($isGudang->save()) {
							$gudangHistory->kode_gudang = $isGudang->kode_gudang;
							$gudangHistory->kode_jenis_gudang = $isGudang->kode_jenis_gudang;
							$gudangHistory->id_gudang = $isGudang->id_gudang;
							$gudangHistory->nama = $isGudang->nama;
							$gudangHistory->alamat = $isGudang->alamat;
							$gudangHistory->kabupaten = $isGudang->kabupaten;
							$gudangHistory->provinsi = $isGudang->provinsi;
							$gudangHistory->latitude = $isGudang->latitude;
							$gudangHistory->longitude = $isGudang->longitude;
							$gudangHistory->luas = $isGudang->luas;
							$gudangHistory->telp = $isGudang->telp;
							$gudangHistory->status = $isGudang->status;
							$gudangHistory->koordinator = $isGudang->koordinator;
							$gudangHistory->created_date = date('Y-m-d H:i:s');
							$created_by = Yii::app()->user->id;
							$gudangHistory->created_by = $created_by;
							$pesan = 'success';
							Yii::app()->user->setFlash('success', 'Data berhasil Dihapus');
							$redirectUrl = "/kospermindo/gudang";
						} else {
							Yii::app()->user->setFlash('error', 'Data Gagal Dihapus');
							$pesan = 'invalid';
						}
						$data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
						echo CJSON::encode($data);
					}
				}
			} else {
				echo CJSON::encode(array('message' => 'Your request is invalid'));
			}
		}

		public function actionUbah()
		{

			$jenis_gudang = !empty($_POST['jenis_gudang']) ? $_POST['jenis_gudang'] : '';
			$nama_gudang = !empty($_POST['nama_gudang']) ? $_POST['nama_gudang'] : '';
			$pj_gudang = !empty($_POST['pj_gudang']) ? $_POST['pj_gudang'] : '';
			$telp = !empty($_POST['telp']) ? $_POST['telp'] : '';
			$luas_gudang = !empty($_POST['luas_gudang']) ? $_POST['luas_gudang'] : '';
			$alamat = !empty($_POST['alamat']) ? $_POST['alamat'] : '';
			$kabupaten = !empty($_POST['kabupaten']) ? $_POST['kabupaten'] : '';
			$provinsi = !empty($_POST['provinsi']) ? $_POST['provinsi'] : '';
			$id = !empty($_POST['id']) ? $_POST['id'] : '';

			$alamatLengkap = $alamat . ", " . $kabupaten . ", " . $provinsi;
			$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($alamatLengkap) . '&sensor=false');
			$geo = json_decode($geo, true);

			if ($geo['status'] = 'OK') {
				$lu = !empty($geo['results'][0]['geometry']['location']['lat']) ? $geo['results'][0]['geometry']['location']['lat'] : '0';
				$ls = !empty($geo['results'][0]['geometry']['location']['lng']) ? $geo['results'][0]['geometry']['location']['lng'] : '0';
			} else {
				$lu = '0';
				$ls = '0';
			}

			$gudang = Gudang::model()->findByAttributes(array('id_gudang' => $id));
			$gudangHistory = new GudangHistory;
			$getAllGudang = Gudang::model()->findByAttributes(array('nama'      => $nama_gudang,
																	'alamat'    => $alamat,
																	'kabupaten' => $kabupaten,
																	'provinsi'  => $provinsi,
																	'status'    => 0,
			));

			$getkode = Gudang::model()->findByAttributes(array('id_gudang' => $id));
			$getjenisgudang = $getkode['kode_jenis_gudang'];
			if ($getjenisgudang !== $jenis_gudang) {
				$lastkode = Gudang::model()->findAllByAttributes(array('kode_jenis_gudang' => $jenis_gudang),
					array('order' => 'id_gudang DESC', 'limit' => 1));
				if (!$lastkode) {
					$kode = $jenis_gudang . '.001';
				} else {
					$getkode = substr($lastkode[0]['kode_gudang'], (strlen($lastkode[0]['kode_gudang']) - 3),
						(strlen($lastkode[0]['kode_gudang'])));
					$getkodesum = '000' . ((int)$getkode + 1);
					$kode = $jenis_gudang . '.' . substr($getkodesum, (strlen($getkodesum) - 3), strlen($getkodesum));
				}
			}
			if ($getAllGudang && ($id !== $getAllGudang['id_gudang'])) {
				$pesan = array('message' => 'any_gudang');
			} else {
				$gudang->kode_jenis_gudang = $jenis_gudang;
				$gudang->nama = $nama_gudang;
				if ($getjenisgudang !== $jenis_gudang) {
					$gudang->kode_gudang = $kode;
				}
				$gudang->alamat = $alamat;
				$gudang->kabupaten = $kabupaten;
				$gudang->provinsi = $provinsi;
				$gudang->luas = $luas_gudang;
				$gudang->telp = $telp;
				$gudang->latitude = $ls;
				$gudang->longitude = $lu;
				$gudang->status = 0;
				$gudang->koordinator = $pj_gudang;
				if ($gudang->save()) {
					$gudangHistory->id_gudang = $gudang->id_gudang;
					$gudangHistory->kode_jenis_gudang = $gudang->kode_jenis_gudang;
					$gudangHistory->kode_gudang = $gudang->kode_gudang;
					$gudangHistory->nama = $gudang->nama;
					$gudangHistory->alamat = $gudang->alamat;
					$gudangHistory->kabupaten = $kabupaten;
					$gudangHistory->provinsi = $provinsi;
					$gudangHistory->latitude = $ls;
					$gudangHistory->longitude = $lu;
					$gudangHistory->luas = $gudang->luas;
					$gudangHistory->telp = $gudang->telp;
					$gudangHistory->status = $gudang->status;
					$gudangHistory->koordinator = $gudang->koordinator;
					$gudangHistory->created_date = date('Y-m-d H:i:s');
					$created_by = Yii::app()->user->id;
					$gudangHistory->created_by = $created_by;

					if ($gudangHistory->save()) {
						Yii::app()->user->setFlash('success', 'Data Gudang berhasil di perbaharui');
						$pesan = array('message' => 'success');
					} else {
						Yii::app()->user->setFlash('failed', 'Data Gudang gagal di perbaharui');
						$pesan = array('message' => 'failed');
					}
				} else {
					Yii::app()->user->setFlash('failed', 'Data Gudang gagal di perbaharui');
					$pesan = array('message' => 'failed');
				}
			}

			echo json_encode($pesan);
		}

		public function actionGetgudang()
		{
			$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';

			$getGudang = Gudang::model()->findByAttributes(array('id_gudang' => $id_gudang));
			$pesan = array(
				'id_gudang'         => $getGudang['id_gudang'],
				'kode_jenis_gudang' => $getGudang['kode_jenis_gudang'],
				'nama'              => $getGudang['nama'],
				'alamat'            => $getGudang['alamat'],
				'kabupaten'         => $getGudang['kabupaten'],
				'provinsi'          => $getGudang['provinsi'],
				'kabupaten'         => $getGudang['kabupaten'],
				'luas'              => $getGudang['luas'],
				'telp'              => $getGudang['telp'],
				'koordinator'       => $getGudang['koordinator'],
				'status'            => $getGudang['status'],
			);
			echo json_encode($pesan);

		}

		public function actionGetDetail()
		{
			$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';

			$getGudang = Gudang::model()->findByAttributes(array('id_gudang' => $id_gudang));
			$jenis_gudang = JenisGudang::model()->findByAttributes(array('kode_jenis_gudang' => $getGudang['kode_jenis_gudang']));
			$provinsi = Provinsi::model()->findByAttributes(array('provinsi_id' => $getGudang['provinsi']));
			$kabupaten = Kotakab::model()->findByAttributes(array('kota_id' => $getGudang['kabupaten']));
			$pesan = array(
				'id_gudang'         => $getGudang['id_gudang'],
				'kode_jenis_gudang' => $jenis_gudang['jenis_gudang'],
				'nama'              => $getGudang['nama'],
				'alamat'            => $getGudang['alamat'],
				'kabupaten'         => $getGudang['kabupaten'],
				'provinsi'          => $provinsi['provinsi_nama'],
				'kabupaten'         => $kabupaten['kokab_nama'],
				'luas'              => $getGudang['luas'],
				'telp'              => $getGudang['telp'],
				'koordinator'       => $getGudang['koordinator'],
				'status'            => $getGudang['status'],
			);
			echo json_encode($pesan);
		}

		protected function performAjaxValidation($model)
		{

			if (isset($_POST['ajax']) && $_POST['ajax'] === 'petani-form') {

				echo CActiveForm::validate($model);

				Yii::app()->end();

			}

		}

	}