<?php

class PengaturanController extends KController
{

	public function actionIndex(){
		
		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("6", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

			$user = Users::model()->findByAttributes(array('id'=>Yii::app()->user->id));

			$countKontak = PusatInformasi::model()->countByAttributes(array('admin_kontak'=>Yii::app()->user->id));
			// $allKontak = PusatInformasi::model()->findAllByAttributes(array('admin_kontak'=>Yii::app()->user->id),array('order'=>'id ASC','limit'=>2));
			$id = Yii::app()->user->id;
			$allKontak = PusatInformasi::model()->getKontak($id);
			// Helper::dd($allKontak);


			$cc2 = '';
			$cc3 = '';
			$telp2 = '';
			$telp3 = '';

			if($countKontak == 0){
				$cc2 = '';
				$cc3 = '';
				$telp2 = '';
				$telp3 = '';
			}elseif($countKontak == 1){
				$cc2 = $allKontak[0]['kontak'];
				$cc3 = '';
				$telp2 = $allKontak[0]['telp'];
				$telp3 = '';
			}elseif($countKontak >= 2){
				$cc2 = $allKontak[0]['kontak'];
				$cc3 = $allKontak[1]['kontak'];
				$telp2 = $allKontak[0]['telp'];
				$telp3 = $allKontak[1]['telp'];
			}


			$this->render('index',
				array(
				'users' => $user,
				'allKontak' => $allKontak,
				'cc2'	=> $cc2,
				'cc3'	=> $cc3,
				'telp2'	=> $telp2,
				'telp3'	=> $telp3
				));
		}else{
			$this->redirect('/kospermindo');
		}
	}


	public function actionIndexold()
	{
    if (Yii::app()->user->isGuest) {
      $this->redirect('/kospermindo/login');
    }
    $model = new Settings;
    $request = Yii::app()->request->getIsPostRequest();

    if($request){
      if(isset($_POST['Settings'])){
        $settings = $_POST['Settings'];
        $model->attributes = $settings;
        $model->site_title = $settings['site-name'];
        $model->site_url = $settings['site-url'];
        $model->email = $settings['email'];
        $model->help_desk_phone = $settings['phone'];
        $model->jumlah_bal = $settings['jumlah-bal'];
        $model->nilai_tetap = $settings['nilai-tetap'];
        $model->biaya_proses = $settings['biaya-proses'];
        $model->biaya_container = $settings['biaya-kontainer'];

        //Helper::dd($settings);
        if($model->save()){
          Yii::app()->user->setFlash('success','Data berhasil disimpan');
        }else{
          Helper::dd($model->errors);
          Yii::app()->user->setFlash('error','Data gagal disimpan');
        }
      }
    }
		$this->render('index-old');
	}


	public function actionUbahakun(){
		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses == 1 || Yii::app()->user->akses == 2){
			$user = Users::model()->findByAttributes(array('id'=>Yii::app()->user->id));

			$this->render('ubah-password', array('user'=>$user));
		}else{
			$this->redirect('/kospermindo');
		}
	}


	public function actionUpdatepass(){
		$request = Yii::app()->request->isPostRequest;

		if($request){
			$pesan = 'failed';

			$id = Yii::app()->user->id;

			$getUserPetani = Petani::model()->findByAttributes(array('username'=>$_POST['username'], 'status_hapus'=>0));
			$getUser = Users::model()->findByAttributes(array('username'=>$_POST['username'], 'status'=>0));				
			$admin = Users::model()->findByAttributes(array('id'=>$id, 'status'=>0));

			if(($getUser && ($id !== $getUser['id'])) || $getUserPetani){
				Yii::app()->user->setFlash('failed','Gagal menyunting username, username telah digunakan');

				$pesan = 'any_user';
			}else{

				/*insert petani*/
				$admin->username = !empty($_POST['username']) ? $_POST['username'] : '';
				$admin->password = CPasswordHelper::hashPassword($_POST['password']);

				if($admin->save()){					
						Yii::app()->user->setFlash('success','Berhasil menyunting username dan password');
						$pesan = 'success';
				}else{
					Yii::app()->user->setFlash('failed','Gagal menyunting username dan password');

					$pesan = 'failed';
				}
			}

			echo json_encode($pesan);
		}
	}

	public function actionUpdate(){
		$telpon = !empty($_POST['telp']) ? $_POST['telp'] : '';
		$telpon2 = !empty($_POST['telp2']) ? $_POST['telp2'] : '';
		$telpon3 = !empty($_POST['telp3']) ? $_POST['telp3'] : '';
		$cc2 = !empty($_POST['cc2']) ? $_POST['cc2'] : '';
		$cc3 = !empty($_POST['cc3']) ? $_POST['cc3'] : '';
		$cc2name = !empty($_POST['cc2name']) ? $_POST['cc2name'] : '';
		$cc3name = !empty($_POST['cc3name']) ? $_POST['cc3name'] : '';

		$admin_kontak = Yii::app()->user->id;
		
		$countKontak = PusatInformasi::model()->countByAttributes(array('admin_kontak'=>$admin_kontak));
		
		$cc2_exist = PusatInformasi::model()->findByAttributes(array('kontak'=>$cc2name,'admin_kontak'=>Yii::app()->user->id));
		$cc3_exist = PusatInformasi::model()->findByAttributes(array('kontak'=>$cc3name,'admin_kontak'=>Yii::app()->user->id));

		if(!empty($cc2_exist)){
			$cc2_exist->kontak = $cc2;
			$cc2_exist->telp = '+62'.$telpon2;
			$cc2_exist->admin_kontak = $admin_kontak;

			if($cc2_exist->save()){
				$pesan = array('message'=>'success');	
			}else{
				$pesan = array('message'=>'failed');
			}
		}else{
			
			$PusatInformasi = new PusatInformasi;
			
			$PusatInformasi->kontak = $cc2;
			$PusatInformasi->telp = '+62'.$telpon2;
			$PusatInformasi->admin_kontak = $admin_kontak;

			if($PusatInformasi->save()){
				$pesan = array('message'=>'success');	
			}else{
				$pesan = array('message'=>'failed');
			}
		}

		if(!empty($cc3_exist)){
			$cc3_exist->kontak = $cc3;
			$cc3_exist->telp = '+62'.$telpon3;
			$cc3_exist->admin_kontak = $admin_kontak;

			if($cc3_exist->save()){
				$pesan = array('message'=>'success');	
			}else{
				$pesan = array('message'=>'failed');
			}
		}else{
			
			$PusatInformasi2 = new PusatInformasi;

			$PusatInformasi2->kontak = $cc3;
			$PusatInformasi2->telp = '+62'.$telpon3;
			$PusatInformasi2->admin_kontak = $admin_kontak;

			if($PusatInformasi2->save()){
				$pesan = array('message'=>'success');	
			}else{
				$pesan = array('message'=>'failed');
			}
		}

		$users = Users::model()->findByAttributes(array('id'=>Yii::app()->user->id));
		$users->no_handphone = '+62'.$telpon;
		if($users->save()){
			Yii::app()->user->setFlash('success','Data Berhasil Disunting');
			$pesan = array('message'=>'success');
		}else{
			Yii::app()->user->setFlash('failed','Data Gagal Disunting');
			$pesan = array('message'=>'failed');

		}
		echo json_encode($pesan);
	}

	public function actionPrakiraanpendapatan(){
		$this->render('prakiraan');
	}

	public function actionModerator(){

		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses ==1){
			$menu = Menu::model()->findAll();
			$page = !empty($_GET['page']) ? $_GET['page'] : 1;

			$users = Users::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id,'su_akses'=>2, 'status'=>0));

			$count_users = count($users);
			$limit = 10;
			$users_count = ceil($count_users/$limit);
			$offset = $limit*($page-1);

			$usersShow = Users::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id,'su_akses'=>2, 'status'=>0), array('limit'=>$limit, 'offset'=>$offset));

			$dataProvider = new CActiveDataProvider('Users', array(
				'countCriteria' => array(
					'condition' => 'su_akses=2 AND status=0 AND '.'id_perusahaan='.Yii::app()->user->id
				),
				'pagination' => array(
					'pageSize' => 10,
					'pageVar' => 'page',
					'route' => $this->createUrl('/kospermindo/moderator')
				)
			));
			

			$this->render('moderator', array(
				'data' => $dataProvider,
				'users' => $usersShow,
				'menu'=>$menu
			));
		}else{
			$this->redirect('/kospermindo');
		}

	}


	public function actionCreatemoderatorusers()
	{
		$users = new Users;
		$usersHistory = new UsersHistory;

		$pesan = '';

		$existuserpetani = Petani::model()->findByAttributes(array('username'=>$_POST['username'], 'status_hapus'=>0));

		$exist = Users::model()->findByAttributes(array('username'=>$_POST['username'], 'status'=>0));

		if($existuserpetani || $exist){
			Yii::app()->user->setFlash('failed', 'Username Telah Digunakan');
			$pesan = array('message'=>'any_user');
		}else{
			$users->username = !empty($_POST['username']) ? $_POST['username'] : '';
			$users->password = !empty($_POST['password']) ? $_POST['password'] : '';
			$users->id_perusahaan = Yii::app()->user->id;
			$users->email = !empty($_POST['email']) ? $_POST['email'] : '';
			$users->no_handphone = !empty($_POST['telp']) ? '+62'.$_POST['telp'] : '';
			$users->su_akses = 2;
			$users->mod_akses = !empty($_POST['menu']) ? $_POST['menu'] : '';
			$users->status = 0;
			if($users->save()){

				$usersHistory->id_users = $users->id;
				$usersHistory->username = $users->username;
				$usersHistory->password = $users->password;
				$usersHistory->id_perusahaan = $users->id_perusahaan;
				$usersHistory->email = $users->email;
				$usersHistory->no_handphone = $users->no_handphone;
				$usersHistory->su_akses = $users->su_akses;
				$usersHistory->mod_akses = $users->mod_akses;
				$usersHistory->status = $users->status;
				$usersHistory->created_by = Yii::app()->user->id;
				$usersHistory->created_date = date('Y-m-d H:i:s');
				$usersHistory->last_login = '';
				if($usersHistory->save()){
					Yii::app()->user->setFlash('success', 'Pengguna Berhasil Ditambahkan');
					$pesan = array('message'=>'success');
				}else{
					Yii::app()->user->setFlash('failed', 'Pengguna Gagal Ditambahkan');
					$pesan = array('message'=>'failed');						
				}

			}else{
				Yii::app()->user->setFlash('failed', 'Pengguna Gagal Ditambahkan');
				$pesan = array('message'=>'failed');
			}
		}

		echo json_encode($pesan);
	}


	public function actionGetmoderatorusers(){
		$getusers = Users::model()->findByAttributes(array('id'=>$_POST['id_users'], 'su_akses'=>2, 'status'=>0));

		$pesan = array(
			'id_users'          => $getusers['id'],
			'email'				=> $getusers['email'],
			'telp'				=> substr($getusers['no_handphone'], 3, strlen($getusers['no_handphone'])),
			'menu'				=> $getusers['mod_akses']
		);
		echo json_encode($pesan);
	}

	public function actionUpdatemoderatorusers()
	{
		$pesan = "";
		$error = 0;
		$id = !empty($_POST['id']) ? $_POST['id'] : '';

		$users = Users::model()->findByAttributes(array('id'=>$id, 'su_akses'=>2, 'status'=>0));
		$usersHistory = new UsersHistory;

		if(empty($_POST['username']) && empty($_POST['password'])){
			$users->email = !empty($_POST['email']) ? $_POST['email'] :'';
			$users->no_handphone = !empty($_POST['telp']) ? '+62'.$_POST['telp'] :'';
			$users->mod_akses = !empty($_POST['menu']) ? $_POST['menu'] :'';
			if($users->save()){
				$usersHistory->id_users = $users->id;
				$usersHistory->username = $users->username;
				$usersHistory->password = $users->password;
				$usersHistory->email = $users->email;
				$usersHistory->no_handphone = $users->no_handphone;
				$usersHistory->su_akses = $users->su_akses;
				$usersHistory->mod_akses = $users->mod_akses;
				$usersHistory->status = $users->status;
				$usersHistory->created_by = Yii::app()->user->id;
				$usersHistory->created_date = date('Y-m-d H:i:s');
				$usersHistory->last_login = '';
				if($usersHistory->save()){
					Yii::app()->user->setFlash('success', 'Pengguna Berhasil Disunting');
					$pesan = array('message'=>'success');
				}else{
					Yii::app()->user->setFlash('failed', 'Pengguna Gagal Disunting');
					$pesan = array('message'=>'failed');
				}
			}else{
				Yii::app()->user->setFlash('failed', 'Pengguna Gagal Disunting');
				$pesan = array('message'=>'failed');
			}
		}else{

			$existuserpetani = Petani::model()->findByAttributes(array('username'=>$_POST['username'], 'status_hapus'=>0));

			$exist = Users::model()->findByAttributes(array('username'=>$_POST['username'], 'status'=>0));

			if(($exist && ($id !== $exist['id'])) || $existuserpetani){
				Yii::app()->user->setFlash('failed', 'Username Telah Digunakan');
				$pesan = array('message'=>'any_user');					
			}else{
				$users->username = !empty($_POST['username']) ? $_POST['username'] :'';
				$users->password = CPasswordHelper::hashPassword($_POST['password']);
				$users->email = !empty($_POST['email']) ? $_POST['email'] :'';
				$users->no_handphone = !empty($_POST['telp']) ? '+62'.$_POST['telp'] :'';
				$users->mod_akses = !empty($_POST['menu']) ? $_POST['menu'] :'';
				if($users->save()){
					$usersHistory->id_users = $users->id;
					$usersHistory->username = $users->username;
					$usersHistory->password = $users->password;
					$usersHistory->email = $users->email;
					$usersHistory->no_handphone = $users->no_handphone;
					$usersHistory->su_akses = $users->su_akses;
					$usersHistory->mod_akses = $users->mod_akses;
					$usersHistory->status = $users->status;
					$usersHistory->created_by = Yii::app()->user->id;
					$usersHistory->created_date = date('Y-m-d H:i:s');
					$usersHistory->last_login = '';
					if($usersHistory->save()){
						Yii::app()->user->setFlash('success', 'Pengguna Berhasil Disunting');
						$pesan = array('message'=>'success');
					}else{
						Yii::app()->user->setFlash('failed', 'Pengguna Gagal Disunting');
						$pesan = array('message'=>'failed');
					}
				}else{
					Yii::app()->user->setFlash('failed', 'Pengguna Gagal Disunting');
					$pesan = array('message'=>'failed');
				}
			}

		}

		echo json_encode($pesan);
	}

	public function actionModeratordelete(){
		$id = Yii::app()->request->getPost('id');
		$users = Users::model()->findByAttributes(array('id'=>$id, 'su_akses'=>2, 'status'=>0));
		$usersHistory = new UsersHistory;

		$users->status = 1;
		if($users->save()){
			$usersHistory->id_users = $users->id;
			$usersHistory->username = $users->username;
			$usersHistory->password = $users->password;
			$usersHistory->email = $users->email;
			$usersHistory->no_handphone = $users->no_handphone;
			$usersHistory->su_akses = $users->su_akses;
			$usersHistory->mod_akses = $users->mod_akses;
			$usersHistory->status = $users->status;
			$usersHistory->created_by = Yii::app()->user->id;
			$usersHistory->created_date = date('Y-m-d H:i:s');
			$usersHistory->last_login = '';
			if($usersHistory->save()){
				Yii::app()->user->setFlash('success', 'Pengguna Berhasil Dihapus');
				$pesan = 'success';
				$redirectUrl = '/kospermindo/moderator';
			}else{
				Yii::app()->user->setFlash('failed', 'Pengguna Gagal Dihapus');
				$pesan = 'invalid';
				$redirectUrl = '/kospermindo/moderator';

			}
		}else{
			Yii::app()->user->setFlash('failed', 'Pengguna Gagal Dihapus');
			$pesan = 'invalid';
			$redirectUrl = '/kospermindo/moderator';	
		}
		
		$data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
		echo CJSON::encode($data);

	}
}