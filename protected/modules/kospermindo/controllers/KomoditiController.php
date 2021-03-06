<?php

	class KomoditiController extends KController
	{

		public function actionIndex()
		{
			$this->layout = '/layouts/main';
			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("1", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

				$page = !empty($_GET['page']) ? $_GET['page'] : 1;

				$komoditi = JenisKomoditi::model()->findAllByAttributes(array('status'=>0));

				$count_komoditi = count($komoditi);
				$limit = 10;
				$komoditi_count = ceil($count_komoditi/$limit);
				$offset = $limit*($page-1);

				$jKomoditiShow = JenisKomoditi::model()->findAllByAttributes(array('status' => 0),
					array('limit' => $limit, 'offset' => $offset));

				$jkomo = array();
				foreach ($jKomoditiShow as $key => $value) {
					if ($value['parent_id'] == 0) {
						$komoid = array('id'        => $value['id_komoditi'],
														'parent_id' => $value['parent_id'],
														'jenis'     => $value['jenis'],
														'sub'       => 'Tidak Ada Sub',
						);
						array_push($jkomo, $komoid);
					} else {
						$getSubKomo = JenisKomoditi::model()->findByAttributes(array('id_komoditi' => $value['parent_id']));
						$komoid = array('id'        => $value['id_komoditi'],
														'parent_id' => $value['parent_id'],
														'jenis'     => $getSubKomo['jenis'],
														'sub'       => $value['jenis'],
						);
						array_push($jkomo, $komoid);

					}
				}

				$dataProvider = new CActiveDataProvider('JenisKomoditi', array(
					'countCriteria' => array(
						'condition' => 'status=0',
					),
					'pagination'    => array(
						'pageSize' => 10,
						'pageVar'  => 'page',
						'route'    => $this->createUrl('/kospermindo/komoditi'),
					),
				));
				

				$this->render('index', array(
					'jenis' => $jkomo,
					'data'  => $dataProvider,
				));
			}else{
				$this->redirect('/kospermindo');

			}
		}

		public function actionCreate()
		{
			$jenis = !empty($_POST['jenis']) ? $_POST['jenis'] : '';
			$sub = !empty($_POST['sub']) ? $_POST['sub'] : '';

			$getKomoditiAll = JenisKomoditi::model()->findAll(array('order' => 'id_komoditi DESC'));

			if (empty($getKomoditiAll[0]['kode_komoditi'])) {
				$kode = '441';
			} else {
				$getkode = substr($getKomoditiAll[0]['kode_komoditi'], (strlen($getKomoditiAll[0]['kode_komoditi']) - 3),
					(strlen($getKomoditiAll[0]['kode_komoditi'])));
				$getkodesum = '441' . ((int)$getkode + 1);
				$kode = substr($getkodesum, (strlen($getkodesum) - 3), strlen($getkodesum));
			}
			// Helper::dd($kode);

			$jKomoditi = new JenisKomoditi;
			$jKomoditiHis = new JenisKomoditiHistory;

			$getKomoditi = JenisKomoditi::model()->findByAttributes(array('id_komoditi' => $sub));

			$jKomoditi->parent_id = !empty($getKomoditi) ? $sub : 0;
			$jKomoditi->jenis = Helper::cleanString($jenis);
			$jKomoditi->kode_komoditi = $kode;
			$jKomoditi->status = 0;
			if ($jKomoditi->save()) {
				$lastKomo = JenisKomoditi::model()->lastRecord()->find();
				$jKomoditiHis->id_komoditi = (int)$lastKomo['id_komoditi'];
				$jKomoditiHis->parent_id = (int)$lastKomo['parent_id'];
				$jKomoditiHis->jenis = Helper::cleanString($lastKomo['jenis']);
				$jKomoditiHis->status = 0;
				$jKomoditiHis->kode_komoditi = $kode;
				$jKomoditiHis->created_date = date('Y-m-d H:i:s');
				$jKomoditiHis->created_by = (int)Yii::app()->user->id;
				if ($jKomoditiHis->save()) {
					Yii::app()->user->setFlash('success', 'Berhasil menambahkan data baru');

					$pesan = array('message' => 'success');
				} else {
					Yii::app()->user->setFlash('failed', 'Gagal menambahkan data baru');

					$pesan = array('message' => 'failed');
				}
			} else {
				Yii::app()->user->setFlash('failed', 'Gagal menambahkan data baru');

				$pesan = array('message' => 'failed');
			}

			echo json_encode($pesan);
		}

		public function actionUpdate()
		{
			$jenis = !empty($_POST['jenis']) ? $_POST['jenis'] : '';
			$sub = !empty($_POST['sub']) ? $_POST['sub'] : '';
			$id = !empty($_POST['id']) ? $_POST['id'] : '';

			$jKomoditi = JenisKomoditi::model()->findByAttributes(array('id_komoditi' => $id));
			$jKomoditiHis = new JenisKomoditiHistory;

			$getKomoditi = JenisKomoditi::model()->findByAttributes(array('id_komoditi' => $sub));

			$jKomoditi->parent_id = !empty($getKomoditi) ? $sub : 0;
			$jKomoditi->jenis = Helper::cleanString($jenis);
			$jKomoditi->status = 0;
			if ($jKomoditi->save()) {
				$jKomoditiHis->id_komoditi = (int)$id;
				$jKomoditiHis->parent_id = !empty($getKomoditi) ? $sub : 0;
				$jKomoditiHis->jenis = Helper::cleanString($jenis);
				$jKomoditiHis->status = 0;
				$jKomoditiHis->created_date = date('Y-m-d H:i:s');
				$jKomoditiHis->created_by = (int)Yii::app()->user->id;
				if ($jKomoditiHis->save()) {
					Yii::app()->user->setFlash('success', 'Berhasil menyunting data');

					$pesan = array('message' => 'success');
				} else {
					Yii::app()->user->setFlash('failed', 'Gagal menyunting data');

					$pesan = array('message' => 'failed');
				}
			} else {
				Yii::app()->user->setFlash('failed', 'Gagal menyunting data');

				$pesan = array('message' => 'failed');
			}

			echo json_encode($pesan);
		}

		public function actionDelete()
		{
			$id = !empty($_POST['id']) ? $_POST['id'] : '';

			$jKomoditi = JenisKomoditi::model()->findByAttributes(array('id_komoditi' => $id));
			$jKomoditiHis = new JenisKomoditiHistory;

			$jKomoditi->status = 1;
			if ($jKomoditi->save()) {
				$jKomoditiHis->id_komoditi = (int)$id;
				$jKomoditiHis->parent_id = $jKomoditi['parent_id'];
				$jKomoditiHis->jenis = Helper::cleanString($jKomoditi['jenis']);
				$jKomoditiHis->status = 1;
				$jKomoditiHis->created_date = date('Y-m-d H:i:s');
				$jKomoditiHis->created_by = (int)Yii::app()->user->id;
				if ($jKomoditiHis->save()) {
					Yii::app()->user->setFlash('success', 'Berhasil menghapus data');

					$pesan = array('message' => 'success');
				} else {
					Yii::app()->user->setFlash('failed', 'Gagal menghapus data');

					$pesan = array('message' => 'failed');
				}
			} else {
				Yii::app()->user->setFlash('failed', 'Gagal menghapus data');

				$pesan = array('message' => 'failed');
			}

			echo json_encode($pesan);
		}

		public function actionListjenis()
		{
			$jenis = JenisKomoditi::model()->findAllByAttributes(array('status' => 0));
			$jkomo = array();

			foreach ($jenis as $key => $value) {
				$komoid = array('jenis' => $value['jenis'], 'id' => $value['id_komoditi']);
				array_push($jkomo, $komoid);
			}
			echo json_encode($jkomo);
		}

		public function actionHarga()
		{
			$komoditi = JenisKomoditi::model();
			$model = new HargaSeaweed;

			$this->render('info-harga', array('model' => $model));
		}
	}