<?php

class ProduksiController extends KController{
	

	public function actionIndex(){
		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses == 3){
	
			$jenis_seaweed = Petani::model()->findByAttributes(array('id_petani'=>Yii::app()->user->id,'status_hapus'=>0));
			$arrSeaweed = array();

			foreach (json_decode($jenis_seaweed['jenis_komoditi']) as $key => $valjns) {
				$getseaweed = JenisKomoditi::model()->findByAttributes(array('id_komoditi'=>$valjns->id,'status'=>0));
				$arrSeaweed[] = array('id_komoditi'=>$valjns->id,'jenis'=>$getseaweed['jenis']);
			}

			$page = !empty($_GET['page']) ? $_GET['page'] : 1;

			$produksi = Seaweed::model()->findAllByAttributes(array('id_user'=>Yii::app()->user->id,'status'=>0));

			$count_produksi = count($produksi);
			$limit = 10;
			$petani_count = ceil($count_produksi/$limit);
			$offset = $limit*($page-1);

			$produksiShow = Seaweed::model()->findAllByAttributes(array('id_user'=>Yii::app()->user->id,'status'=>0), array('limit'=>$limit, 'offset'=>$offset));
			

			$dataProvider = new CActiveDataProvider('Seaweed', array(
				'countCriteria' => array(
					'condition' => 'status=0 AND id_user='.Yii::app()->user->id
				),
				'pagination' => array(
					'pageSize' => 10,
					'pageVar' => 'page',
					'route' => $this->createUrl('/kospermindo/produksi')
				)
			));

			$this->render('index',
				array('jenis_seaweed'=>$arrSeaweed,
					'history'=>$produksiShow,
					'data'=>$dataProvider)
				);
		}else{
			$this->redirect('/kospermindo');

		}
	}

	public function actionCreateproduksi(){
		$id_user = Yii::app()->user->id;
		$hasil = !empty($_POST['hasil']) ? $_POST['hasil'] : '';
		$kadar_air = !empty($_POST['kadar_air']) ? $_POST['kadar_air'] : '';
		$seaweed = !empty($_POST['seaweed']) ? $_POST['seaweed'] : '';

		$petani = Petani::model()->findByAttributes(array('id_petani'=>$id_user, 'status_hapus'=>0));
		$gudang = Gudang::model()->findByAttributes(array('kode_gudang'=>$petani['kode_gudang'],'status'=>0));
		$kelompok = Kelompok::model()->findByAttributes(array('kode_kelompok'=>$petani['kode_kelompok'],'status'=>0));

		$id_gudang = $gudang['id_gudang'];
		$id_kelompok = $kelompok['id_kelompok'];
        $kode = $id_user . date('ymd') . date('his') . $seaweed . rand(0, 9);

		$Seaweed = new Seaweed;
		$Seaweed->kode_produksi = $kode;
		$Seaweed->id_user = $id_user;
		$Seaweed->id_gudang = $id_gudang;
		$Seaweed->id_kelompok = $id_kelompok;
		$Seaweed->id_seaweed = $seaweed;
		$Seaweed->kadar_air = $kadar_air;
		$Seaweed->total_panen = $hasil;
		$Seaweed->created_date = date('Y-m-d H:i:s');
		$Seaweed->created_by = json_encode(array('id'=>$id_user,'akses'=>Yii::app()->user->akses));
		$Seaweed->status = 0;
		if($Seaweed->save()){
			Yii::app()->user->setFlash('success','Data Berhasil di simpan');
			$pesan = array('message'=>'success');
		}else{
			Yii::app()->user->setFlash('failed','Data Gagal di simpan');
			$pesan = array('message'=>'success');
		}

		echo json_encode($pesan);

	}

	public function actionGetproduksi(){
		$getseaweed = Seaweed::model()->findByAttributes(array('id'=>$_POST['id'], 'status'=>0));

		$pesan = array(
			'id'    		=> $getseaweed['id'],
			'hasil'			=> number_format((float)$getseaweed['total_panen'], 2, '.', '') ,
			'kadar_air'		=> number_format((float)$getseaweed['kadar_air'], 2, '.', ''),
			'seaweed'		=> $getseaweed['id_seaweed']
		);
		echo json_encode($pesan);
	}

	public function actionEditproduksi(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';
		$hasil = !empty($_POST['hasil']) ? $_POST['hasil'] : '';
		$kadar_air = !empty($_POST['kadar_air']) ? $_POST['kadar_air'] : '';
		$seaweed = !empty($_POST['seaweed']) ? $_POST['seaweed'] : '';

		$Seaweed = Seaweed::model()->findByAttributes(array('id'=>$id,'status'=>0));
		$Seaweed->id_seaweed = $seaweed;
		$Seaweed->kadar_air = $kadar_air;
		$Seaweed->total_panen = $hasil;
		$Seaweed->created_date = date('Y-m-d H:i:s');
		$Seaweed->created_by = json_encode(array('id'=>Yii::app()->user->id,'akses'=>Yii::app()->user->akses));
		if($Seaweed->save()){
			Yii::app()->user->setFlash('success','Data Berhasil di sunting');
			$pesan = array('message'=>'success');
		}else{
			Yii::app()->user->setFlash('failed','Data Gagal di sunting');
			$pesan = array('message'=>'success');
		}

		echo json_encode($pesan);

	}

	public function actionDelete(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';

		$Seaweed = Seaweed::model()->findByAttributes(array('id'=>$id,'status'=>0));
		$Seaweed->created_date = date('Y-m-d H:i:s');
		$Seaweed->created_by = json_encode(array('id'=>Yii::app()->user->id,'akses'=>Yii::app()->user->akses));
		$Seaweed->status = 1;

		if($Seaweed->save()){
			Yii::app()->user->setFlash('success', 'Data Berhasil Dihapus');
			$pesan = 'success';
			if(Yii::app()->user->akses == 3){
				$redirectUrl = '/kospermindo/produksi';			
			}else{
				$redirectUrl = '/kospermindo/produksi/admin';							
			}
		}else{
			Yii::app()->user->setFlash('failed', 'Data Gagal Dihapus');
			$pesan = 'invalid';
			if(Yii::app()->user->akses == 3){
				$redirectUrl = '/kospermindo/produksi';			
			}else{
				$redirectUrl = '/kospermindo/produksi/admin';							
			}

		}		
		$data = array('message' => $pesan, 'redirect_url' => $redirectUrl);		
		echo json_encode($data);

	}

	public function actionAdmin(){
		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("2", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){
	
			$gudang = Gudang::model()->findAllByAttributes(array('status'=>0), array('order'=>'kode_jenis_gudang'));

			$arrJnsKomoditi = array();
			$jenis_komoditi = array();
			$petani = array();

			if (Yii::app()->user->hasFlash('id_petani') && Yii::app()->user->hasFlash('id_kelompok') && Yii::app()->user->hasFlash('id_gudang')) {
				$id_gudang = CHtml::encode(Yii::app()->user->getFlash('id_gudang'));
				$id_klpk = CHtml::encode(Yii::app()->user->getFlash('id_kelompok'));
				$id_petani = CHtml::encode(Yii::app()->user->getFlash('id_petani'));

				$get_gudang = Gudang::model()->findAllByAttributes(array('id_gudang'=>$id_gudang, 'status'=>0));
				$kode_gudang = !empty($get_gudang) ? $get_gudang[0]['kode_gudang'] : '0';
				$kelompok = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang, 'status'=>0));				
				$get_kelompok = Kelompok::model()->findAllByAttributes(array('id_kelompok'=>$id_klpk, 'status'=>0));				
				$kode_kelompok = !empty($get_kelompok) ? $get_kelompok[0]['kode_kelompok'] : '0';
				$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang,'kode_kelompok'=>$kode_kelompok,'status_hapus'=>0));

			}else{

				$get_gudang = Gudang::model()->findAllByAttributes(array('status'=>0), array('order'=>'kode_jenis_gudang'));

				$id_gudang = !empty($get_gudang) ? $get_gudang[0]['id_gudang'] : '0';
				$kode_gudang = !empty($get_gudang) ? $get_gudang[0]['kode_gudang'] : '0';
				$kelompok = Kelompok::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang));
				$id_klpk = !empty($kelompok) ? $kelompok[0]['id_kelompok'] : '0';
				$kode_kelompok = !empty($kelompok) ? $kelompok[0]['kode_kelompok'] : '0';

				$petani = Petani::model()->findAllByAttributes(array('kode_gudang'=>$kode_gudang,'kode_kelompok'=>$kode_kelompok,'status_hapus'=>0));
				$id_petani = !empty($petani) ? $petani[0]['id_petani'] : '0';
			}


			$jenis_seaweed = Petani::model()->findByAttributes(array('id_petani'=>$id_petani,'status_hapus'=>0));
			$arrSeaweed = array();
			$arrJenisSeaweed = !empty($jenis_seaweed['jenis_komoditi']) ? json_decode($jenis_seaweed['jenis_komoditi']) : array();

			foreach ($arrJenisSeaweed as $key => $valjns) {
				$getseaweed = JenisKomoditi::model()->findByAttributes(array('id_komoditi'=>$valjns->id,'status'=>0));
				$arrSeaweed[] = array('id_komoditi'=>$valjns->id,'jenis'=>$getseaweed['jenis']);
			}

			$page = !empty($_GET['page']) ? $_GET['page'] : 1;

			$produksi = Seaweed::model()->findAllByAttributes(array('id_user'=>Yii::app()->user->id,'status'=>0));

			$count_produksi = count($produksi);
			$limit = 10;
			$petani_count = ceil($count_produksi/$limit);
			$offset = $limit*($page-1);

			$produksiShow = Seaweed::model()->findAllByAttributes(array('id_user'=>$id_petani,'status'=>0), array('limit'=>$limit, 'offset'=>$offset));
			
			$dataProvider = new CActiveDataProvider('Seaweed', array(
				'countCriteria' => array(
					'condition' => 'status=0 AND id_user='.$id_petani
				),
				'pagination' => array(
					'pageSize' => 10,
					'pageVar' => 'page',
					'route' => $this->createUrl('/kospermindo/produksi')
				)
			));

			$this->render('admin',
				array('jenis_seaweed'=>$arrSeaweed,
					'history'=>$produksiShow,
					'data'=>$dataProvider,
					'gudang' => $gudang,
					'kelompok'=>$kelompok,
					'petani' => $petani,
					'id_gudang' => $id_gudang,
					'id_klpk' => $id_klpk,
					'id_tani' => $id_petani)
				);
		}else{
			$this->redirect('/kospermindo');

		}
	}

	public function actionGetpetani(){
		$id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '0';
		$idKelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '0';
		$idPetani = !empty($_POST['id_petani']) ? $_POST['id_petani'] : '0';

		Yii::app()->user->setFlash('id_kelompok',$idKelompok);
		Yii::app()->user->setFlash('id_petani',$idPetani);
		Yii::app()->user->setFlash('id_gudang',$id_gudang);

		$pesan = array('message'=>'success');

		echo json_encode($pesan);
	}

	public function actionCreateproduksiadmin(){
		$id_user = Yii::app()->user->id;
		$id_petani = !empty($_POST['id_petani']) ? $_POST['id_petani'] : '';
		$hasil = !empty($_POST['hasil']) ? $_POST['hasil'] : '';
		$kadar_air = !empty($_POST['kadar_air']) ? $_POST['kadar_air'] : '';
		$seaweed = !empty($_POST['seaweed']) ? $_POST['seaweed'] : '';

		$petani = Petani::model()->findByAttributes(array('id_petani'=>$id_petani, 'status_hapus'=>0));
		$gudang = Gudang::model()->findByAttributes(array('kode_gudang'=>$petani['kode_gudang'],'status'=>0));
		$kelompok = Kelompok::model()->findByAttributes(array('kode_kelompok'=>$petani['kode_kelompok'],'status'=>0));

		$id_gudang = $gudang['id_gudang'];
		$id_kelompok = $kelompok['id_kelompok'];
        $kode = $id_petani . date('ymd') . date('his') . $seaweed . rand(0, 9);

		$Seaweed = new Seaweed;
		$Seaweed->kode_produksi = $kode;
		$Seaweed->id_user = $id_petani;
		$Seaweed->id_gudang = $id_gudang;
		$Seaweed->id_kelompok = $id_kelompok;
		$Seaweed->id_seaweed = $seaweed;
		$Seaweed->kadar_air = $kadar_air;
		$Seaweed->total_panen = $hasil;
		$Seaweed->created_date = date('Y-m-d H:i:s');
		$Seaweed->created_by = json_encode(array('id'=>$id_user,'akses'=>Yii::app()->user->akses));
		$Seaweed->status = 0;
		if($Seaweed->save()){
			Yii::app()->user->setFlash('success','Data Berhasil di simpan');
			$pesan = array('message'=>'success');
		}else{
			Yii::app()->user->setFlash('failed','Data Gagal di simpan');
			$pesan = array('message'=>'success');
		}

		echo json_encode($pesan);

	}
}
