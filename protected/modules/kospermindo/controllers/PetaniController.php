<?php

	class PetaniController extends KController
	{
		public function actionView($id)
		{
			$this->render('view', array(
				'model' => $this->loadModel($id),
			));
		}


		public function actionCreate(){
			$request = Yii::app()->request->isPostRequest;

			if($request){
				$pesan = 'failed';
				$gambar = CUploadedFile::getInstanceByName('foto');
				$getUser = Petani::model()->findByAttributes(array('username'=>$_POST['username'], 'status_hapus'=>1));				
				if($getUser){
					$pesan = 'any_user';
				}else{
					if(empty($gambar)){
						$getImage = Yii::app()->getBaseUrl(true)."/static/admin/images/profile-picture.png";
					}else{
						$imgname = 'img_' . date('Y-m-d-H-i-s') . '_' . rand(1, 1000);
						$filename_err = explode(".",$gambar->getName());
						$filename_err_count = count($filename_err);
						$file_ext = $filename_err[$filename_err_count-1];
						$size = getimagesize($gambar->getTempName());

						move_uploaded_file($gambar->getTempName(), "images/".$imgname."_kospermindo".".".$file_ext);
						
						$getImage = Yii::app()->getBaseUrl(true)."/images/".$imgname."_kospermindo".".".$file_ext;

					}

					/*insert petani*/
					$petani = new Petani;
					$petani->id_gudang = !empty($_POST['gudang']) ? (int)$_POST['gudang'] : '';
					$petani->id_kelompok = !empty($_POST['kelompok']) ? (int)$_POST['kelompok'] : '';
					$petani->id_perusahaan = (int)Yii::app()->user->id;
					$petani->nama_petani = !empty($_POST['nama_lengkap']) ? Helper::cleanString($_POST['nama_lengkap']) : '';
					$petani->nik = !empty($_POST['nomor_identitas']) ? $_POST['nomor_identitas'] : '';
					$petani->alamat = !empty($_POST['alamat']) ? Helper::cleanString($_POST['alamat']) : '';
					$petani->provinsi = !empty($_POST['provinsi']) ? $_POST['provinsi'] : '';
					$petani->kabupaten = !empty($_POST['kabupaten']) ? $_POST['kabupaten'] : '';
					$petani->no_telp = !empty($_POST['no_telp']) ? '+62'.$_POST['no_telp'] : '';
					$petani->tempat_lahir = !empty($_POST['tempat_lahir']) ? Helper::cleanString($_POST['tempat_lahir']) : '';
					$petani->tgl_lahir = !empty($_POST['tanggal_lahir']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['tanggal_lahir']))) : '';
					$petani->luas_lahan = !empty($_POST['luas_lokasi']) ? (int)$_POST['luas_lokasi'] : '';
					$petani->jumlah_bentangan = !empty($_POST['jumlah_bentangan']) ? (int)$_POST['jumlah_bentangan'] : '';
					$petani->jenis_komoditi = !empty($_POST['jenis']) ? $_POST['jenis'] : '';
					$petani->url_foto = $getImage;
					$petani->username = !empty($_POST['username']) ? $_POST['username'] : '';
					$petani->password = !empty($_POST['password']) ? $_POST['password'] : '';
					$petani->device_id = '';
					$petani->status_login = 0;
					$petani->status_hapus = 1;

					if($petani->save()){
						$petani_last = Petani::model()->lastRecord()->find();
						
						/*insert petani*/
						$petanihis = new PetaniHistory;
						$petanihis->id_petani = $petani_last['id_petani'];
						$petanihis->id_gudang = !empty($_POST['gudang']) ? (int)$_POST['gudang'] : '';
						$petanihis->id_kelompok = !empty($_POST['kelompok']) ? (int)$_POST['kelompok'] : '';
						$petanihis->id_perusahaan = (int)Yii::app()->user->id;
						$petanihis->nama_petani = !empty($_POST['nama_lengkap']) ? Helper::cleanString($_POST['nama_lengkap']) : '';
						$petanihis->nik = !empty($_POST['nomor_identitas']) ? $_POST['nomor_identitas'] : '';
						$petanihis->alamat = !empty($_POST['alamat']) ? Helper::cleanString($_POST['alamat']) : '';
						$petanihis->provinsi = !empty($_POST['provinsi']) ? $_POST['provinsi'] : '';
						$petanihis->kabupaten = !empty($_POST['kabupaten']) ? $_POST['kabupaten'] : '';
						$petanihis->no_telp = !empty($_POST['no_telp']) ? '+62'.$_POST['no_telp'] : '';
						$petanihis->tempat_lahir = !empty($_POST['tempat_lahir']) ? Helper::cleanString($_POST['tempat_lahir']) : '';
						$petanihis->tgl_lahir = !empty($_POST['tanggal_lahir']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['tanggal_lahir']))) : '';
						$petanihis->luas_lahan = !empty($_POST['luas_lokasi']) ? (int)$_POST['luas_lokasi'] : '';
						$petanihis->jumlah_bentangan = !empty($_POST['jumlah_bentangan']) ? (int)$_POST['jumlah_bentangan'] : '';
						$petanihis->jenis_komoditi = !empty($_POST['jenis']) ? $_POST['jenis'] : '';
						$petanihis->url_foto = $getImage;
						$petanihis->username = !empty($_POST['username']) ? $_POST['username'] : '';
						$petanihis->password = $petani_last['password'];
						$petanihis->device_id = '';
						$petanihis->status_login = 0;
						$petanihis->status_hapus = 1;
						$petanihis->created_date = date('Y-m-d H:i:s');
						$petanihis->created_by = (int)Yii::app()->user->id;

						if($petanihis->save()){
							$pesan = 'success';
						}else{
							$pesan = 'failed';
						}

					}else{
						$pesan = 'failed';
					}
				}

				echo json_encode($pesan);
			}
		}

		public function actionUpdate(){

			$request = Yii::app()->request->isPostRequest;

			if($request){
				$pesan = 'failed';
				$gambar = CUploadedFile::getInstanceByName('foto');
				$id = !empty($_GET['id']) ? $_GET['id'] : '';
				$getUser = Petani::model()->findByAttributes(array('username'=>'o', 'status_hapus'=>1));				
				$petani = Petani::model()->findByAttributes(array('id_petani'=>$id, 'status_hapus'=>1));
				if($getUser && ($id !== $getUser['id_petani'])){
					$pesan = 'any_user';
				}else{
					if(empty($gambar)){
						$getImage = $petani['url_foto'];
					}else{
						$imgname = 'img_' . date('Y-m-d-H-i-s') . '_' . rand(1, 1000);
						$filename_err = explode(".",$gambar->getName());
						$filename_err_count = count($filename_err);
						$file_ext = $filename_err[$filename_err_count-1];
						$size = getimagesize($gambar->getTempName());

						move_uploaded_file($gambar->getTempName(), "images/".$imgname."_kospermindo".".".$file_ext);
						
						$getImage = Yii::app()->getBaseUrl(true)."/images/".$imgname."_kospermindo".".".$file_ext;

					}

					/*insert petani*/
					$petani->id_gudang = !empty($_POST['gudang']) ? (int)$_POST['gudang'] : '';
					$petani->id_kelompok = !empty($_POST['kelompok']) ? (int)$_POST['kelompok'] : '';
					$petani->id_perusahaan = (int)Yii::app()->user->id;
					$petani->nama_petani = !empty($_POST['nama_lengkap']) ? Helper::cleanString($_POST['nama_lengkap']) : '';
					$petani->nik = !empty($_POST['nomor_identitas']) ? $_POST['nomor_identitas'] : '';
					$petani->alamat = !empty($_POST['alamat']) ? Helper::cleanString($_POST['alamat']) : '';
					$petani->provinsi = !empty($_POST['provinsi']) ? $_POST['provinsi'] : '';
					$petani->kabupaten = !empty($_POST['kabupaten']) ? $_POST['kabupaten'] : '';
					$petani->no_telp = !empty($_POST['no_telp']) ? '+62'.$_POST['no_telp'] : '';
					$petani->tempat_lahir = !empty($_POST['tempat_lahir']) ? Helper::cleanString($_POST['tempat_lahir']) : '';
					$petani->tgl_lahir = !empty($_POST['tanggal_lahir']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['tanggal_lahir']))) : '';
					$petani->luas_lahan = !empty($_POST['luas_lokasi']) ? (int)$_POST['luas_lokasi'] : '';
					$petani->jumlah_bentangan = !empty($_POST['jumlah_bentangan']) ? (int)$_POST['jumlah_bentangan'] : '';
					$petani->jenis_komoditi = !empty($_POST['jenis']) ? $_POST['jenis'] : '';
					$petani->url_foto = $getImage;
					$petani->status_login = 0;
					$petani->status_hapus = 1;

					if($petani->save()){
						$petani_last = Petani::model()->lastRecord()->find();
						
						/*insert petani*/
						$petanihis = new PetaniHistory;
						$petanihis->id_petani = $petani['id_petani'];
						$petanihis->id_gudang = !empty($_POST['gudang']) ? (int)$_POST['gudang'] : '';
						$petanihis->id_kelompok = !empty($_POST['kelompok']) ? (int)$_POST['kelompok'] : '';
						$petanihis->id_perusahaan = (int)Yii::app()->user->id;
						$petanihis->nama_petani = !empty($_POST['nama_lengkap']) ? Helper::cleanString($_POST['nama_lengkap']) : '';
						$petanihis->nik = !empty($_POST['nomor_identitas']) ? $_POST['nomor_identitas'] : '';
						$petanihis->alamat = !empty($_POST['alamat']) ? Helper::cleanString($_POST['alamat']) : '';
						$petanihis->provinsi = !empty($_POST['provinsi']) ? $_POST['provinsi'] : '';
						$petanihis->kabupaten = !empty($_POST['kabupaten']) ? $_POST['kabupaten'] : '';
						$petanihis->no_telp = !empty($_POST['no_telp']) ? '+62'.$_POST['no_telp'] : '';
						$petanihis->tempat_lahir = !empty($_POST['tempat_lahir']) ? Helper::cleanString($_POST['tempat_lahir']) : '';
						$petanihis->tgl_lahir = !empty($_POST['tanggal_lahir']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['tanggal_lahir']))) : '';
						$petanihis->luas_lahan = !empty($_POST['luas_lokasi']) ? (int)$_POST['luas_lokasi'] : '';
						$petanihis->jumlah_bentangan = !empty($_POST['jumlah_bentangan']) ? (int)$_POST['jumlah_bentangan'] : '';
						$petanihis->jenis_komoditi = !empty($_POST['jenis']) ? $_POST['jenis'] : '';
						$petanihis->url_foto = $getImage;
						$petanihis->username = $petani['username'];
						$petanihis->password = $petani['password'];
						$petanihis->device_id = $petani['device_id'];
						$petanihis->status_login = 0;
						$petanihis->status_hapus = 1;
						$petanihis->created_date = date('Y-m-d H:i:s');
						$petanihis->created_by = (int)Yii::app()->user->id;

						if($petanihis->save()){
							$pesan = 'success';
						}else{
							$pesan = 'failed';
						}

					}else{
						$pesan = 'failed';
					}
				}

				echo json_encode($pesan);
			}
		}

		public function actionUpdatepass(){
			$request = Yii::app()->request->isPostRequest;

			if($request){
				$pesan = 'failed';

				$id = !empty($_GET['id']) ? $_GET['id'] : '';

				$getUser = Petani::model()->findByAttributes(array('username'=>$_POST['username'], 'status_hapus'=>1));				
				$petani = Petani::model()->findByAttributes(array('id_petani'=>$id, 'status_hapus'=>1));

				if($getUser && ($id !== $getUser['id_petani'])){
					$pesan = 'any_user';
				}else{

					/*insert petani*/
					$petani->username = !empty($_POST['username']) ? $_POST['username'] : '';
					$petani->password = CPasswordHelper::hashPassword($_POST['password']);

					if($petani->save()){
						
						/*insert petani*/
						$petanihis = new PetaniHistory;
						$petanihis->id_petani = $petani['id_petani'];
						$petanihis->id_gudang = $petani['id_gudang'];
						$petanihis->id_kelompok = $petani['id_kelompok'];
						$petanihis->id_perusahaan = $petani['id_perusahaan'];
						$petanihis->nama_petani = $petani['nama_petani'];
						$petanihis->nik = $petani['nik'];
						$petanihis->alamat = $petani['alamat'];
						$petanihis->provinsi = $petani['provinsi'];
						$petanihis->kabupaten = $petani['kabupaten'];
						$petanihis->no_telp = $petani['no_telp'];
						$petanihis->tempat_lahir = $petani['tempat_lahir'];
						$petanihis->tgl_lahir = $petani['tgl_lahir'];
						$petanihis->luas_lahan = $petani['luas_lahan'];
						$petanihis->jumlah_bentangan = $petani['jumlah_bentangan'];
						$petanihis->jenis_komoditi = $petani['jenis_komoditi'];
						$petanihis->url_foto = $petani['url_foto'];
						$petanihis->username = $petani['username'];
						$petanihis->password = CPasswordHelper::hashPassword($_POST['password']);
						$petanihis->device_id = $petani['device_id'];;
						$petanihis->status_login = 0;
						$petanihis->status_hapus = 0;
						$petanihis->created_date = date('Y-m-d H:i:s');
						$petanihis->created_by = (int)Yii::app()->user->id;
						if($petanihis->save()){
							$pesan = 'success';
						}else{
							$pesan = 'failed';
						}

					}else{
						$pesan = 'failed';
					}
				}

				echo json_encode($pesan);
			}
		}

		public function actionTambah(){

			$jnsKomoditi = JenisKomoditi::model()->findAllByAttributes(array('status'=>1));
			$arrJnsKomoditi = array();

			foreach ($jnsKomoditi as $key => $value) {
				if($value->parent_id == 0){
					$childJnsKomoditi = JenisKomoditi::model()->findAllByAttributes(array('parent_id'=>$value->id_komoditi, 'status'=>1));
					if($childJnsKomoditi){
						$arr = array('hasChild'=>1,'parent'=>$value, 'child'=>$childJnsKomoditi);
						array_push($arrJnsKomoditi, $arr);
					}else{
						$arr = array('hasChild'=>0,'parent'=>$value, 'child'=>'');
						array_push($arrJnsKomoditi, $arr);
					}
				}
			}

			$this->render('create', array(
				'jenis_komoditi' => $arrJnsKomoditi
			));
		}
		
		public function actionSunting(){
			$id = !empty($_GET['id']) ? $_GET['id'] : '';

			$petani = Petani::model()->findByAttributes(array('id_petani'=>$id, 'status_hapus'=>1));
			$prov = Provinsi::model()->findAll();
			$gudang = Gudang::model()->findAllByAttributes(array('status'=>1));

			$jnsKomoditi = JenisKomoditi::model()->findAllByAttributes(array('status'=>1));
			$arrJnsKomoditi = array();

			foreach ($jnsKomoditi as $key => $value) {
				if($value->parent_id == 0){
					$childJnsKomoditi = JenisKomoditi::model()->findAllByAttributes(array('parent_id'=>$value->id_komoditi, 'status'=>1));
					if($childJnsKomoditi){
						$arr = array('hasChild'=>1,'parent'=>$value, 'child'=>$childJnsKomoditi);
						array_push($arrJnsKomoditi, $arr);
					}else{
						$arr = array('hasChild'=>0,'parent'=>$value, 'child'=>'');
						array_push($arrJnsKomoditi, $arr);
					}
				}
			}

			$this->render('sunting',
				array(
					'petani' => $petani,
					'jenis_komoditi' => $arrJnsKomoditi,
					'provinsi' => $prov,
					'gudang' => $gudang
				)
			);
		}


	public function actionGetprov(){
		$prov = Provinsi::model()->findAll();
		$provinsi = array();
		foreach ($prov as $key => $value) {
			array_push($provinsi, $value->provinsi_nama);
		};
		echo json_encode($provinsi);
	}


	public function actionGetkota(){
		$prov = !empty($_POST['prov']) ? $_POST['prov'] : '';
		$getProv = Provinsi::model()->findByAttributes(array('provinsi_nama'=>$prov));
		$getKota = Kotakab::model()->findAllByAttributes(array('provinsi_id'=>$getProv['provinsi_id']));
		$kota = array();
		foreach ($getKota as $key => $value) {
			array_push($kota, $value->kokab_nama);
		};
		echo json_encode($kota);
	}

	public function actionGetgudang(){
		$gudang = Gudang::model()->findAllByAttributes(array('status'=>1));
		$arrGudang = array();
		foreach ($gudang as $key => $value) {
			$arr = array('id'=>$value->id_gudang, 'value'=>$value->nama);
			array_push($arrGudang, $arr);
		};
		echo json_encode($arrGudang);
	}


	public function actionGetkelompok(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';

		$getKel = Kelompok::model()->findAllByAttributes(array('id_gudang'=>$id, 'status'=>1));
		$arrKel = array();
		foreach ($getKel as $key => $value) {
			$arr = array('id'=>$value->id_kelompok, 'value'=>$value->nama_kelompok);
			array_push($arrKel, $arr);
		};
		echo json_encode($arrKel);
	}

	public function actionDelete(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';

		$petani = Petani::model()->findByAttributes(array('id_petani'=>$id, 'status_hapus'=>1));
		$petanihis = new PetaniHistory;

		$petani->status_hapus = 0;
		if($petani->save()){
			$petanihis->id_petani = $petani['id_petani'];
			$petanihis->id_gudang = $petani['id_gudang'];
			$petanihis->id_kelompok = $petani['id_kelompok'];
			$petanihis->id_perusahaan = $petani['id_perusahaan'];
			$petanihis->nama_petani = $petani['nama_petani'];
			$petanihis->nik = $petani['nik'];
			$petanihis->alamat = $petani['alamat'];
			$petanihis->provinsi = $petani['provinsi'];
			$petanihis->kabupaten = $petani['kabupaten'];
			$petanihis->no_telp = $petani['no_telp'];
			$petanihis->tempat_lahir = $petani['tempat_lahir'];
			$petanihis->tgl_lahir = $petani['tgl_lahir'];
			$petanihis->luas_lahan = $petani['luas_lahan'];
			$petanihis->jumlah_bentangan = $petani['jumlah_bentangan'];
			$petanihis->jenis_komoditi = $petani['jenis_komoditi'];
			$petanihis->url_foto = $petani['url_foto'];
			$petanihis->username = $petani['username'];
			$petanihis->password = $petani['password'];
			$petanihis->device_id = $petani['device_id'];;
			$petanihis->status_login = 0;
			$petanihis->status_hapus = 0;
			$petanihis->created_date = date('Y-m-d H:i:s');
			$petanihis->created_by = (int)Yii::app()->user->id;
			if($petanihis->save()){
				$pesan = array('message'=>'success');
			}else{
				$pesan = array('message'=>'failed');
			}
		}else{
			$pesan = array('message'=>'failed');
		}

		echo json_encode($pesan);
	}






















		public function ActionListkelompok()
		{
			$isGudang = Gudang::model()->findByAttributes(array('lokasi'=>$_POST['nilai']));
			$data=TabelKelompok::model()->findAll('idgudang=:parent_id AND status=:status',array(':parent_id'=>$isGudang->id,':status'=>1));
			
			$data=CHtml::listData($data,'id','nama_kelompok');
			foreach($data as $value=>$name)
			{
				echo CHtml::tag('option',
				array('value'=>$value,'name'=>'idkelompok'),CHtml::encode($name),true);
			}
		}

		public function actionUbah($id){
			$update = 'yes';
			$pesan = '';
			$id = Yii::app()->request->getParam('id');
			if($id){
				$isPetani = TabelPetani::model()->findByAttributes(array('id'=>$id));
				$isGudang = Gudang::model()->findByAttributes(array('id'=>$isPetani->idgudang));
				if(!empty($isPetani)){
					if(isset($_POST['TabelPetani'])){
						$jenisRumputLaut = implode(',', $_POST['jenisRumputLaut']);
						$isPetani->attributes = $_POST['TabelPetani'];
						$isPetani->jenis_komoditi = $jenisRumputLaut;
						$isPetani->id = $id;
						if ($isPetani->save()) {
							$pesan = 'Data berhasil disimpan';
							Yii::app()->user->setFlash('success','Data berhasil di perbaharui');
							$this->redirect('/kospermindo/petani');
						} else {
							//Helper::dd($isPetani);
							Yii::app()->user->setFlash('success','Data gagal di perbaharui');
							$pesan = 'Data Gagal disimpan';
						}
					}
					$this->render('update', array(
							'model_petani' => $isPetani,
							'model_gudang' => $isGudang,
							'pesan'=> $pesan,
							'update' =>$update
						));  
				}
			}
		}
		public function actionHapus(){
			$req = Yii::app()->request->getIsPostRequest();
			$ajax = Yii::app()->request->getIsAjaxRequest();
			$id = Yii::app()->request->getPost('id');
			//Helper::dd($id);
			$pesan = '';
			$redirectUrl = "/user";
			$status = 0;
			if ($req && $ajax) {
				if($id){
					$isPetani = TabelPetani::model()->findByAttributes(array('id'=>$id));
					$isUser = Pengguna::model()->findByAttributes(array('id'=>$isPetani->id_user));
					if(!empty($isPetani)){
								$isPetani->status = $status;
								$isUser->status = $status;
								$isPetani->id = $id;
								$isUser->id = $isPetani->id_user;
								if($isPetani->save() && $isUser->save()){
									$pesan = 'success';
									Yii::app()->user->setFlash('success','Data berhasil Dihapus');
									$redirectUrl = "/kospermindo/petani";
								}else{
									Yii::app()->user->setFlash('error','Data Gagal disimpan');
									$pesan = 'invalid';
								}
						$data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
						echo CJSON::encode($data);
					}

					}
			}else{
				echo CJSON::encode(array('message' => 'Your request is invalid'));
			}
			
		}
		

		public function actionDetails($id)
		{
			$petani = TabelPetani::model()->findByAttributes(array('id_user' => $id));
			$this->render('details', array(
				'model_petani' => $petani,
			));
		}

		

		/**
		 * Lists all models.
		 */
		public function actionIndex()
		{
			if (Yii::app()->user->isGuest) {
				$this->redirect('/kospermindo/login');
			}

			$page = !empty($_GET['page']) ? $_GET['page'] : 1;

			$petani = Petani::model()->findAllByAttributes(array('status_hapus'=>1));

			$count_petani = count($petani);
			$limit = 10;
			$petani_count = ceil($count_petani/$limit);
			$offset = $limit*($page-1);

			$petaniShow = Petani::model()->findAllByAttributes(array('status_hapus'=>1), array('limit'=>$limit, 'offset'=>$offset));
			

			$dataProvider = new CActiveDataProvider('Petani', array(
				'countCriteria' => array(
					'condition' => 'status_hapus=1'
				),
				'pagination' => array(
					'pageSize' => 10,
					'pageVar' => 'page',
					'route' => $this->createUrl('/kospermindo/petani')
				)
			));

			$this->render('index', array(
				'data' => $dataProvider,
				'petani' => $petaniShow

			));
		}

		/**
		 * Manages all models.
		 */
		public function actionAdmin()
		{
			if (Yii::app()->user->isGuest) {
				$this->redirect('/login');
			}

			$model = new Petani('search');
			$model->unsetAttributes();  // clear any default values
			if (isset($_GET['m_petani'])) {
				$model->attributes = $_GET['m_petani'];
			}

			$this->render('admin', array(
				'model' => $model,
			));
		}

		/**
		 * Returns the data model based on the primary key given in the GET variable.
		 * If the data model is not found, an HTTP exception will be raised.
		 *
		 * @param integer $id the ID of the model to be loaded
		 *
		 * @return Petani the loaded model
		 * @throws CHttpException
		 */
		public function loadModel($id)
		{
			$model = Petani::model()->findByPk($id);
			if ($model === null) {
				throw new CHttpException(404, 'The requested page does not exist.');
			}

			return $model;
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
