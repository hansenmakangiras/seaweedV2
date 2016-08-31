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
			$getUserAdmin = Users::model()->findByAttributes(array('username'=>$_POST['username'], 'status'=>0));				
			$getUser = Petani::model()->findByAttributes(array('username'=>$_POST['username'], 'status_hapus'=>0));				
			$getUserNik = Petani::model()->findByAttributes(array('nik'=>$_POST['nomor_identitas'], 'status_hapus'=>0));				
			if($getUser || $getUserAdmin){
				$pesan = 'any_user';
			}else if($getUserNik){
				$pesan = 'any_ktp' ;
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
				
				$lastkode = Petani::model()->findAllByAttributes(array('kode_kelompok'=>$_POST['kelompok']), array('order'=>'id_petani DESC', 'limit'=>1));
				if(!$lastkode){
					$kode = $_POST['kelompok'].'.0001';
				}else{
					$getkode = substr($lastkode[0]['kode_petani'], (strlen($lastkode[0]['kode_petani'])-4), (strlen($lastkode[0]['kode_petani']))) ;
					$getkodesum = '0000'.((int)$getkode + 1);
					$kode = $_POST['kelompok'].'.'.substr($getkodesum , (strlen($getkodesum)-4), strlen($getkodesum));
				}

				$id_perusahaan = (Yii::app()->user->akses == 1) ? Yii::app()->user->id : Users::model()->getCompanyId(Yii::app()->user->id);
				/*insert petani*/
				$petani = new Petani;
				$petani->kode_petani = $kode;
				$petani->kode_jenis_gudang = !empty($_POST['jenis_gudang']) ? $_POST['jenis_gudang'] : '';
				$petani->kode_gudang = !empty($_POST['gudang']) ? $_POST['gudang'] : '';
				$petani->kode_kelompok = !empty($_POST['kelompok']) ? $_POST['kelompok'] : '';
				$petani->id_perusahaan = (int)$id_perusahaan;
				$petani->nama_petani = !empty($_POST['nama_lengkap']) ? Helper::cleanString($_POST['nama_lengkap']) : '';
				$petani->nik = !empty($_POST['nomor_identitas']) ? $_POST['nomor_identitas'] : '';
				$petani->alamat = !empty($_POST['alamat']) ? Helper::cleanString($_POST['alamat']) : '';
				$petani->provinsi = !empty($_POST['provinsi']) ? (int)$_POST['provinsi'] : '';
				$petani->kabupaten = !empty($_POST['kabupaten']) ? (int)$_POST['kabupaten'] : '';
				$petani->no_telp = !empty($_POST['no_telp']) ? '+62'.$_POST['no_telp'] : '';
				$petani->tempat_lahir = !empty($_POST['tempat_lahir']) ? Helper::cleanString($_POST['tempat_lahir']) : '';
				$petani->tgl_lahir = !empty($_POST['tanggal_lahir']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['tanggal_lahir']))) : '';
				$petani->jenis_komoditi = !empty($_POST['jenis']) ? $_POST['jenis'] : '';
				$petani->url_foto = $getImage;
				$petani->username = !empty($_POST['username']) ? $_POST['username'] : '';
				$petani->password = !empty($_POST['password']) ? $_POST['password'] : '';
				$petani->device_id = '';
				$petani->status_login = 0;
				$petani->status_hapus = 0;

				if($petani->save()){
					/*insert petani*/
					$petanihis = new PetaniHistory;
					$petanihis->id_petani = $petani->id_petani;
					$petanihis->kode_petani = $petani->kode_petani;
					$petanihis->kode_jenis_gudang = $petani->kode_jenis_gudang;
					$petanihis->kode_gudang = $petani->kode_gudang;
					$petanihis->kode_kelompok = $petani->kode_kelompok;
					$petanihis->id_perusahaan = $petani->id_perusahaan;
					$petanihis->nama_petani = $petani->nama_petani;
					$petanihis->nik = $petani->nik;
					$petanihis->alamat = $petani->alamat;
					$petanihis->provinsi = $petani->provinsi;
					$petanihis->kabupaten = $petani->kabupaten;
					$petanihis->no_telp = $petani->no_telp;
					$petanihis->tempat_lahir = $petani->tempat_lahir;
					$petanihis->tgl_lahir = $petani->tgl_lahir;
					$petanihis->jenis_komoditi = $petani->jenis_komoditi;
					$petanihis->url_foto = $petani->url_foto;
					$petanihis->username = $petani->username;
					$petanihis->password = $petani->password;
					$petanihis->device_id = $petani->device_id;
					$petanihis->status_login = $petani->status_login;
					$petanihis->status_hapus = $petani->status_hapus;
					$petanihis->created_date = date('Y-m-d H:i:s');
					$petanihis->created_by = (int)Yii::app()->user->id;

					if($petanihis->save()){
						Yii::app()->user->setFlash('success','Berhasil menambahkan data baru');
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
			$getUser = Petani::model()->findByAttributes(array('username'=>'o', 'status_hapus'=>0));
			$getUserNik = Petani::model()->findByAttributes(array('nik'=>$_POST['nomor_identitas'], 'status_hapus'=>0));				
			$petani = Petani::model()->findByAttributes(array('id_petani'=>$id, 'status_hapus'=>0));
			$getUserAdmin = Users::model()->findByAttributes(array('username'=>'o', 'status'=>0));				

			if(($getUser && ($id !== $getUser['id_petani'])) || $getUserAdmin ){
				$pesan = 'any_user';
			}else if($getUserNik && ($id !== $getUserNik['id_petani'])){
				$pesan = 'any_ktp';
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

				$getkode = Petani::model()->findByAttributes(array('id_petani'=>$id));
				$getkodekelompok = $getkode['kode_kelompok'];
				if($_POST['kelompok'] !== $getkodekelompok){
					$lastkode = Petani::model()->findAllByAttributes(array('kode_kelompok'=>$_POST['kelompok']), array('order'=>'id_petani DESC', 'limit'=>1));
					if(!$lastkode){
						$kode = $_POST['kelompok'].'.0001';
					}else{
						$getkode = substr($lastkode[0]['kode_petani'], (strlen($lastkode[0]['kode_petani'])-4), (strlen($lastkode[0]['kode_petani']))) ;
						$getkodesum = '0000'.((int)$getkode + 1);
						$kode = $_POST['kelompok'].'.'.substr($getkodesum , (strlen($getkodesum)-4), strlen($getkodesum));
					}
				}

				/*insert petani*/
				if($getkodekelompok !== $_POST['kelompok']){
					$petani->kode_petani = $kode;
				}
				$petani->kode_jenis_gudang = !empty($_POST['jenis_gudang']) ? $_POST['jenis_gudang'] : '';
				$petani->kode_gudang = !empty($_POST['gudang']) ? $_POST['gudang'] : '';
				$petani->kode_kelompok = !empty($_POST['kelompok']) ? $_POST['kelompok'] : '';
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
				$petani->status_hapus = 0;

				if($petani->save()){
					
					/*insert petani*/
					$petanihis = new PetaniHistory;
					$petanihis->id_petani = $petani->id_petani;
					$petanihis->kode_petani = $petani->kode_petani;
					$petanihis->kode_jenis_gudang = $petani->kode_jenis_gudang;
					$petanihis->kode_gudang = $petani->kode_gudang;
					$petanihis->kode_kelompok = $petani->kode_kelompok;
					$petanihis->id_perusahaan = $petani->id_perusahaan;
					$petanihis->nama_petani = $petani->nama_petani;
					$petanihis->nik = $petani->nik;
					$petanihis->alamat = $petani->alamat;
					$petanihis->provinsi = $petani->provinsi;
					$petanihis->kabupaten = $petani->kabupaten;
					$petanihis->no_telp = $petani->no_telp;
					$petanihis->tempat_lahir = $petani->tempat_lahir;
					$petanihis->tgl_lahir = $petani->tgl_lahir;
					$petanihis->jenis_komoditi = $petani->jenis_komoditi;
					$petanihis->url_foto = $petani->url_foto;
					$petanihis->username = $petani->username;
					$petanihis->password = $petani->password;
					$petanihis->device_id = $petani->device_id;
					$petanihis->status_login = $petani->status_login;
					$petanihis->status_hapus = $petani->status_hapus;
					$petanihis->created_date = date('Y-m-d H:i:s');
					$petanihis->created_by = (int)Yii::app()->user->id;

					if($petanihis->save()){
						Yii::app()->user->setFlash('success','Berhasil menyunting data');

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

			$getUser = Petani::model()->findByAttributes(array('username'=>$_POST['username'], 'status_hapus'=>0));				
			$petani = Petani::model()->findByAttributes(array('id_petani'=>$id, 'status_hapus'=>0));
			$getUserAdmin = Users::model()->findByAttributes(array('username'=>$_POST['username'], 'status'=>0));				

			if(($getUser && ($id !== $getUser['id_petani'])) || $getUserAdmin ){
				Yii::app()->user->setFlash('failed','Gagal menyunting username, username telah digunakan');

				$pesan = 'any_user';
			}else{

				/*insert petani*/
				$petani->username = !empty($_POST['username']) ? $_POST['username'] : '';
				$petani->password = CPasswordHelper::hashPassword($_POST['password']);

				if($petani->save()){
					
					/*insert petani*/
					$petanihis = new PetaniHistory;
					$petanihis->id_petani = $petani->id_petani;
					$petanihis->kode_petani = $petani->kode_petani;
					$petanihis->kode_jenis_gudang = $petani->kode_jenis_gudang;
					$petanihis->kode_gudang = $petani->kode_gudang;
					$petanihis->kode_kelompok = $petani->kode_kelompok;
					$petanihis->id_perusahaan = $petani->id_perusahaan;
					$petanihis->nama_petani = $petani->nama_petani;
					$petanihis->nik = $petani->nik;
					$petanihis->alamat = $petani->alamat;
					$petanihis->provinsi = $petani->provinsi;
					$petanihis->kabupaten = $petani->kabupaten;
					$petanihis->no_telp = $petani->no_telp;
					$petanihis->tempat_lahir = $petani->tempat_lahir;
					$petanihis->tgl_lahir = $petani->tgl_lahir;
					$petanihis->jenis_komoditi = $petani->jenis_komoditi;
					$petanihis->url_foto = $petani->url_foto;
					$petanihis->username = $petani->username;
					$petanihis->password = $petani->password;
					$petanihis->device_id = $petani->device_id;
					$petanihis->status_login = $petani->status_login;
					$petanihis->status_hapus = $petani->status_hapus;
					$petanihis->created_date = date('Y-m-d H:i:s');
					$petanihis->created_by = (int)Yii::app()->user->id;
					if($petanihis->save()){
						Yii::app()->user->setFlash('success','Berhasil menyunting username dan password');

						$pesan = 'success';
					}else{
						Yii::app()->user->setFlash('failed','Gagal menyunting username dan password');

						$pesan = 'failed';
					}

				}else{
					Yii::app()->user->setFlash('failed','Gagal menyunting username dan password');

					$pesan = 'failed';
				}
			}

			echo json_encode($pesan);
		}
	}

	public function actionTambah(){

		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("1", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

			$jnsKomoditi = JenisKomoditi::model()->findAllByAttributes(array('status'=>0));
			$arrJnsKomoditi = array();

			foreach ($jnsKomoditi as $key => $value) {
				if($value->parent_id == 0){
					$childJnsKomoditi = JenisKomoditi::model()->findAllByAttributes(array('parent_id'=>$value->id_komoditi, 'status'=>0));
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
		}else{
			$this->redirect('/kospermindo');
		}
	}
		
	public function actionSunting(){

		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("1", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

			$id = !empty($_GET['id']) ? $_GET['id'] : '';

			$petani = Petani::model()->findByAttributes(array('id_petani'=>$id, 'status_hapus'=>0));
			$prov = Provinsi::model()->findAll();
			$Kotakab = Kotakab::model()->findAllByAttributes(array('provinsi_id'=>$petani['provinsi']));
			$jenisGudang = JenisGudang::model()->findAll();

			$jnsKomoditi = JenisKomoditi::model()->findAllByAttributes(array('status'=>0));
			$arrJnsKomoditi = array();

			foreach ($jnsKomoditi as $key => $value) {
				if($value->parent_id == 0){
					$childJnsKomoditi = JenisKomoditi::model()->findAllByAttributes(array('parent_id'=>$value->id_komoditi, 'status'=>0));
					if($childJnsKomoditi){
						$arr = array('hasChild'=>1,'parent'=>$value, 'child'=>$childJnsKomoditi);
						array_push($arrJnsKomoditi, $arr);
					}else{
						$arr = array('hasChild'=>0,'parent'=>$value, 'child'=>'');
						array_push($arrJnsKomoditi, $arr);
					}
				}
			}

			$gudang = Gudang::model()->findAllByAttributes(array('kode_jenis_gudang'=>$petani['kode_jenis_gudang'],'status'=>0));
			$kelompok = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$petani['kode_gudang'],'status'=>0));
			$this->render('sunting',
				array(
					'petani' => $petani,
					'jenis_komoditi' => $arrJnsKomoditi,
					'provinsi' => $prov,
					'kabupaten' => $Kotakab,
					'jenis_gudang' => $jenisGudang,
					'gudang' => $gudang,
					'kelompok' => $kelompok
				)
			);
		}else{
			$this->redirect('/kospermindo');
		}
	}


	public function actionGetprov(){
		$prov = Provinsi::model()->findAll();
		$provinsi = array();
		foreach ($prov as $key => $value) {
			$arr = array('id'=>$value->provinsi_id, 'nama'=>$value->provinsi_nama);
			array_push($provinsi, $arr);
		};
		echo json_encode($provinsi);
	}


	public function actionGetkota(){
		$prov = !empty($_POST['prov']) ? $_POST['prov'] : '';
		$getKota = Kotakab::model()->findAllByAttributes(array('provinsi_id'=>$prov));
		$kota = array();
		foreach ($getKota as $key => $value) {
			$arr = array('id'=>$value->kota_id, 'nama'=>$value->kokab_nama);
			array_push($kota, $arr);
		};
		echo json_encode($kota);
	}

	public function actionGetjenisgudang(){
		$jenisgudang = JenisGudang::model()->findAll();
		$arrGudang = array();
		foreach ($jenisgudang as $key => $value) {
			$arr = array('id'=>$value->kode_jenis_gudang, 'value'=>$value->jenis_gudang);
			array_push($arrGudang, $arr);
		};
		echo json_encode($arrGudang);
	}

	public function actionGetgudang(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';
		$gudang = Gudang::model()->findAllByAttributes(array('kode_jenis_gudang'=>$id,'status'=>0));
		$arrGudang = array();
		foreach ($gudang as $key => $value) {
			$arr = array('id'=>$value->kode_gudang, 'value'=>$value->nama);
			array_push($arrGudang, $arr);
		};
		echo json_encode($arrGudang);
	}


	public function actionGetkelompok(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';

		$gudang = Gudang::model()->findByAttributes(array('id_gudang'=>$id,'status'=>0));
		$getKel = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$gudang['kode_gudang'], 'status'=>0));
		$arrKel = array();
		foreach ($getKel as $key => $value) {
			$arr = array('id'=>$value->id_kelompok, 'value'=>$value->nama_kelompok);
			array_push($arrKel, $arr);
		};
		echo json_encode($arrKel);
	}

	public function actionGetpetani(){
		$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
		$id_kelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '';

		$gudang = Gudang::model()->findByAttributes(array('id_gudang'=>$id_gudang));
		$kelompok = Kelompok::model()->findByAttributes(array('id_kelompok'=>$id_kelompok));

		$getPetani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$gudang['kode_gudang'],'kode_kelompok'=>$kelompok['kode_kelompok'], 'status_hapus'=>0));
		$arrPetani = array();
		foreach ($getPetani as $key => $value) {
			$arr = array('id'=>$value->id_petani, 'value'=>$value->nama_petani);
			array_push($arrPetani, $arr);
		};
		echo json_encode($arrPetani);
	}

	public function actionDelete(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';

		$petani = Petani::model()->findByAttributes(array('id_petani'=>$id, 'status_hapus'=>0));
		$petanihis = new PetaniHistory;

		$petani->status_hapus = 1;
		if($petani->save()){
			$petanihis->id_petani = $petani['id_petani'];
			$petanihis->kode_petani = $petani['kode_petani'];
			$petanihis->kode_jenis_gudang = $petani['kode_jenis_gudang'];
			$petanihis->kode_gudang = $petani['kode_gudang'];
			$petanihis->kode_kelompok = $petani['kode_kelompok'];
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
			$petanihis->status_hapus = 1;
			$petanihis->created_date = date('Y-m-d H:i:s');
			$petanihis->created_by = (int)Yii::app()->user->id;
			if($petanihis->save()){
				Yii::app()->user->setFlash('success','Berhasil menghapus data');

				$pesan = array('message'=>'success');
			}else{
				Yii::app()->user->setFlash('failed','Gagal menghapus data');

				$pesan = array('message'=>'failed');
			}
		}else{
			Yii::app()->user->setFlash('failed','Gagal menghapus data');

			$pesan = array('message'=>'failed');
		}

		echo json_encode($pesan);
	}



	public function actionHasil(){
    	$client = Elasticsearch\ClientBuilder::create()->setHosts(['localhost:9200'])->build();

    	$json = '{
				  "query": { 
				    	"bool": { 
				    		must": [
				    			"match_all" : {}
				    		],

				    	}
				  	}
				}
    	';

    	$params = [
    		'index' => 'hasil_produksi',
    		'type' => 'type_hasil_produksi',
    		'body' => $json
    	];
      
    	$respons =  $client->search($params);

    	var_dump($respons);
	}


		/**
		 * Lists all models.
		 */
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("1", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

			$page = !empty($_GET['page']) ? $_GET['page'] : 1;

			$petani = Petani::model()->findAllByAttributes(array('status_hapus'=>0));

			$count_petani = count($petani);
			$limit = 10;
			$petani_count = ceil($count_petani/$limit);
			$offset = $limit*($page-1);

			$petaniShow = Petani::model()->findAllByAttributes(array('status_hapus'=>0), array('limit'=>$limit, 'offset'=>$offset));
			

			$dataProvider = new CActiveDataProvider('Petani', array(
				'countCriteria' => array(
					'condition' => 'status_hapus=0'
				),
				'pagination' => array(
					'pageSize' => 10,
					'pageVar' => 'page',
					'route' => $this->createUrl('/kospermindo/petani')
				)
			));

			$this->render('index', array(
				'data' => $dataProvider,
				'petani' => $petaniShow,
			));
		}else{
			$this->redirect('/kospermindo');

		}
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
