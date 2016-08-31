<?php

	class KelompokController extends KController

	{

		public function actionIndex()

		{

			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("1", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){
				$pesan = '';
				$page = !empty($_GET['page']) ? $_GET['page'] : 1;
				$kelompok = Kelompok::model()->findAllByAttributes(array('status'=>0));
				$count_kelompok = count($kelompok);
				$limit = 10;
				$kelompok_count = ceil($count_kelompok/$limit);
				$offset = $limit*($page-1);
				$jenisGudang = JenisGudang::model()->findAll();
				$dataProvider = new CActiveDataProvider('Kelompok', array(
					'countCriteria' => array(
						'condition' => 'status=0'
					),
					'criteria'      => array(
						'condition' => 'status=0',
						'order'     => 'id_kelompok ASC',
					),
					'pagination' => array(
						'pageSize' => 10,
						'pageVar' => 'page',
						'route' => $this->createUrl('/kospermindo/kelompok')
					)
				));

				$namaGudang = Gudang::model()->findAllByAttributes(array('status' => 0));
				$this->render('index', array(
					'data' => $dataProvider,
					'namaGudang' => $namaGudang,
					'jenisGudang' => $jenisGudang
				));
			}else{
				$this->redirect('/kospermindo');
			}

		}

		public function actionGetNamaGudang()
		{
			$gudang = Gudang::model()->findAllByAttributes(array('status' => 1));
			$isGudang = array();
			foreach ($gudang as $key => $value) {
				array_push($isGudang, $value->nama);
			};
			echo json_encode($isGudang);
		}

		public function actionGetPetani()
		{
			$id_kelompok = !empty($_POST['id_kelompok']) ? Helper::cleanString($_POST['id_kelompok']) :'';
			$kelompok = Kelompok::model()->findByAttributes(array('id_kelompok'=>$id_kelompok));
			$petaniAll = array();

			if(!empty($kelompok)){
				$petani = Petani::model()->findAllByAttributes(array('kode_kelompok' => $kelompok['kode_kelompok']));
				foreach ($petani as $key => $value) {
					$petaniAll[] = array('id' => $value->id_petani, 'nama_petani' => $value->nama_petani);
				}
			}  

			echo json_encode($petaniAll);
		}

		public function actionTambah()
		{
			$nama_kelompok = !empty($_POST['nama_kelompok']) ? $_POST['nama_kelompok'] : '';
			$jenis_gudang = !empty($_POST) ? $_POST['jenis_gudang'] : '';
			$kode_gudang = !empty($_POST) ? $_POST['kode_gudang'] : '';
			$ketua_kelompok = !empty($_POST['ketua_kelompok']) ? $_POST['ketua_kelompok'] : '';
			$kelompok = new Kelompok;

			$kelompokHistory = new KelompokHistory;

			$status = 0;
			$pesan = '';
			$getSameKelompok = Kelompok::model()->findByAttributes(array('nama_kelompok' => $nama_kelompok, 'status' => 0, 'kode_gudang' => $kode_gudang));

			$lastkode = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang), array('order'=>'kode_kelompok DESC', 'limit'=>1));
			if(!$lastkode){
				$kode = $kode_gudang.'.001';
			}else{
				$getkode = substr($lastkode[0]['kode_kelompok'], (strlen($lastkode[0]['kode_kelompok'])-3), (strlen($lastkode[0]['kode_kelompok'])));
				$getkodesum = '000'.((int)$getkode + 1);
				$kode = $kode_gudang.'.'.substr($getkodesum , (strlen($getkodesum)-3), strlen($getkodesum));
			}

			if (empty($getSameKelompok)) {
				if (isset($nama_kelompok) && isset($kode_gudang)) {
					$kelompok->nama_kelompok = $nama_kelompok;
					$kelompok->kode_jenis_gudang = $jenis_gudang;
					$kelompok->kode_gudang = $kode_gudang;
					$kelompok->kode_kelompok = $kode;
					$kelompok->ketua_kelompok = $ketua_kelompok;
					$kelompok->status = $status;
					if ($kelompok->save()) {
						$kelompokHistory->id_kelompok = $kelompok->id_kelompok;
						$kelompokHistory->nama_kelompok = $kelompok->nama_kelompok;
						$kelompokHistory->kode_jenis_gudang = $kelompok->kode_jenis_gudang;
						$kelompokHistory->kode_gudang = $kelompok->kode_gudang;
						$kelompokHistory->kode_kelompok = $kelompok->kode_kelompok;
						$kelompokHistory->ketua_kelompok = $kelompok->ketua_kelompok;
						$kelompokHistory->status = $kelompok->status;
						$kelompokHistory->created_date = date('Y-m-d H:i:s');
						$created_by = Yii::app()->user->id;
						$kelompokHistory->created_by = $created_by;
						if ($kelompokHistory->save()) {
							Yii::app()->user->setFlash('success', 'Data kelompok berhasil di simpan');
							$pesan = array('message' => 'success');
						} else {
							//Yii::app()->user->setFlash('failed', 'Data kelompok gagal di simpan');
							$pesan = array('message' => 'failed');
						}
					} else {
						//Yii::app()->user->setFlash('failed', 'Data kelompok gagal di simpan');
						$pesan = array('message' => 'failed');
					}
				}
			} else {
				$pesan = array('message' => 'double');
			}			
			echo json_encode($pesan);
		}

		public function actionUbah()
		{
			$nama_kelompok = !empty($_POST['nama_kelompok']) ? $_POST['nama_kelompok'] : '';
			$kode_jenis_gudang = !empty($_POST['kode_jenis_gudang']) ? $_POST['kode_jenis_gudang'] : '';
			$kode_gudang = !empty($_POST['kode_gudang']) ? $_POST['kode_gudang'] : '';
			$ketua_kelompok = !empty($_POST['ketua_kelompok']) ? $_POST['ketua_kelompok'] : '';
			$id = !empty($_POST['id']) ? $_POST['id'] : '';

			$kelompok = Kelompok::model()->findByAttributes(array('id_kelompok'=>$id));
			$getkodegudang = $kelompok['kode_gudang'];
			if ($getkodegudang !== $kode_gudang) {
				$lastkode = Kelompok::model()->findAllByAttributes(array('kode_gudang' => $kode_gudang),
					array('order' => 'id_kelompok DESC', 'limit' => 1));
				if (!$lastkode) {
					$kode = $kode_gudang . '.001';
				} else {
					$getkode = substr($lastkode[0]['kode_kelompok'], (strlen($lastkode[0]['kode_kelompok']) - 3),
						(strlen($lastkode[0]['kode_kelompok'])));
					$getkodesum = '000' . ((int)$getkode + 1);
					$kode = $kode_gudang . '.' . substr($getkodesum, (strlen($getkodesum) - 3), strlen($getkodesum));
				}
			}

			$getSameKelompok = Kelompok::model()->findByAttributes(array('nama_kelompok' => $nama_kelompok, 'status' => 0, 'kode_gudang' => $kode_gudang));
			$kelompokHistory = new KelompokHistory;
			if ($getSameKelompok && ($id !== $getSameKelompok['id_kelompok'])) {
				$pesan = array('message' => 'double');
			} else {

				$kelompok->kode_jenis_gudang = $kode_jenis_gudang;
				$kelompok->kode_gudang = $kode_gudang;
				if ($getkodegudang !== $kode_gudang) {
					$kelompok->kode_kelompok = $kode;
				}

				$kelompok->nama_kelompok = $nama_kelompok;
				$kelompok->ketua_kelompok = $ketua_kelompok;
				$kelompok->status = 0;
				if ($kelompok->save()) {
					$kelompokHistory->id_kelompok = $kelompok->id_kelompok;
					$kelompokHistory->kode_gudang = $kelompok->kode_gudang;
					$kelompokHistory->kode_kelompok = $kelompok->kode_kelompok;
					$kelompokHistory->nama_kelompok = $kelompok->nama_kelompok;
					$kelompokHistory->kode_jenis_gudang = $kelompok->kode_jenis_gudang;
					$kelompokHistory->ketua_kelompok = $kelompok->ketua_kelompok;
					$kelompokHistory->status = $kelompok->status;
					$kelompokHistory->created_date = date('Y-m-d H:i:s');
					$created_by = Yii::app()->user->id;
					$kelompokHistory->created_by = $created_by;
					if ($kelompokHistory->save()) {
						Yii::app()->user->setFlash('success', 'Data kelompok berhasil di perbaharui');
						$pesan = array('message' => 'success');
					} else {
						$pesan = array('message' => 'failed');
					}
				} else {
					$pesan = array('message' => 'failed');
				}
			}

			echo json_encode($pesan);
		}

		public function actionHapus()

		{

			$req = Yii::app()->request->getIsPostRequest();
			$ajax = Yii::app()->request->getIsAjaxRequest();

			$id = Yii::app()->request->getPost('id');
			$pesan = '';
			$redirectUrl = "/kospermindo/kelompok";
			$status = 1;
			if ($req && $ajax) {
				if ($id) {
					$isKelompok = Kelompok::model()->findByAttributes(array('id_kelompok' => $id));
					$kelompokHistory = new KelompokHistory;
					if (!empty($isKelompok)) {
						$isKelompok->status = $status;
						if ($isKelompok->save()) {
							$kelompokHistory->id_kelompok = $isKelompok->id_kelompok;
							$kelompokHistory->kode_gudang = $isKelompok->kode_gudang;
							$kelompokHistory->kode_kelompok = $isKelompok->kode_kelompok;
							$kelompokHistory->nama_kelompok = $isKelompok->nama_kelompok;
							$kelompokHistory->kode_jenis_gudang = $isKelompok->kode_jenis_gudang;
							$kelompokHistory->ketua_kelompok = $isKelompok->ketua_kelompok;
							$kelompokHistory->status = $isKelompok->status;
							$kelompokHistory->created_date = date('Y-m-d H:i:s');
							$created_by = Yii::app()->user->id;
							$kelompokHistory->created_by = $created_by;
							if ($kelompokHistory->save()) {
								Yii::app()->user->setFlash('success', 'Data kelompok berhasil terhapus');
								$pesan = 'success';
								$redirectUrl = "/kospermindo/kelompok";
							} else {
								Yii::app()->user->setFlash('success', 'Data kelompok gagal terhapus');
								$pesan = 'failed';
								$redirectUrl = "/kospermindo/kelompok";
							}
						} else {
							Yii::app()->user->setFlash('error', 'Data kelompok gagal terhapus');
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

		public function actiongetGudang(){
			$jenis_gudang = !empty($_POST['jenis_gudang']) ? $_POST['jenis_gudang'] : '';

				if(!empty($jenis_gudang)){

					$nama_gudang = Gudang::model()->findAllByAttributes(array('kode_jenis_gudang'=>$jenis_gudang, 'status'=>0));

					$namaGudang = array();

					foreach ($nama_gudang as $key => $value) {

						$arr = array('id'=>$value->kode_gudang, 'nama'=>$value->nama);

						array_push($namaGudang, $arr);

					};

					echo CJSON::encode($namaGudang);

					Yii::app()->end();

				}

		}

		public function actionGetsuntingkelompok(){
			
			$id_kelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '';

			$kelompok = Kelompok::model()->findByAttributes(array('id_kelompok'=>$id_kelompok));

			$ketua_kelompok = Petani::model()->findByAttributes(array('id_petani'=>$kelompok->ketua_kelompok));

			//Helper::dd($gudang);

			$pesan = array(
					'nama_kelompok'=>$kelompok['nama_kelompok'],
					'kode_jenis_gudang'=>$kelompok['kode_jenis_gudang'],
					'kode_gudang' => $kelompok['kode_gudang'],
					'ketua_kelompok'=>$kelompok['ketua_kelompok'],
					'id_kelompok'=>$kelompok['id_kelompok']
				);
			echo json_encode($pesan);
		}


		public function actionDetail()

		{

			$id = $_GET['id'];

			if ($id) {

				$model = TabelKelompok::model()->findAllByAttributes(array('idgudang' => (int)$id));


			}

			$this->render('showFarmers', array(

				'model' => $model,

			));

		}

		public function actionView($id)
		{

			$this->render('view', array(

				'model' => $this->loadModel($id),

			));

		}

		/**
		 * Returns the data model based on the primary key given in the GET variable.
		 * If the data model is not found, an HTTP exception will be raised.
		 *
		 * @param integer $id the ID of the model to be loaded
		 *
		 * @return TabelKelompok the loaded model
		 * @throws CHttpException
		 */

		public function loadModel($id)
		{

			$model = TabelKelompok::model()->findByPk($id);

			if ($model === null) {

				throw new CHttpException(404, 'The requested page does not exist.');

			}

			return $model;

		}

		public function actionLihatkelompok($id_koordinator)
		{

			$kelompok = M_kelompok::showKelompokByKor($id_koordinator);

			Helper::dd($kelompok);

		}

		//lihat data petani berdasarkan id kelompok

		/**
		 * Creates a new model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 */

		public function actionShowForm()

		{

			$this->render('formtambah');

		}

		public function actionlihatpetani()

		{

			if (Yii::app()->request->isPostRequest) {

				if (Yii::app()->request->getPost('lihat')) {

					$apa = $_POST['cek'];

				 

					var_dump($apa);

					

				}

			}

		}

		public function actionAdmin()

		{

			$model = new Petani('search');

			$model->unsetAttributes();  // clear any default values

			if (isset($_GET['Petani'])) {

				$model->attributes = $_GET['Petani'];

			}

			$this->render('admin', array(

				'model' => $model,

			));

		}

		/**
		 * Performs the AJAX validation.
		 *
		 * @param Petani $model the model to be validated
		 */

		protected function performAjaxValidation($model)
		{

			if (isset($_POST['ajax']) && $_POST['ajax'] === 'petani-form') {

				echo CActiveForm::validate($model);

				Yii::app()->end();

			}

		}

	}
