<?php

class ModeratorController extends KController{
	
	public function actionIndex(){

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
			

			$this->render('index', array(
				'data' => $dataProvider,
				'users' => $usersShow,
				'menu'=>$menu
			));
		}else{
			$this->redirect('/kospermindo');
		}

	}

	public function actionCreateUsers()
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

	public function actionGetusers(){
		$getusers = Users::model()->findByAttributes(array('id'=>$_POST['id_users'], 'su_akses'=>2, 'status'=>0));

		$pesan = array(
			'id_users'          => $getusers['id'],
			'email'				=> $getusers['email'],
			'telp'				=> substr($getusers['no_handphone'], 3, strlen($getusers['no_handphone'])),
			'menu'				=> $getusers['mod_akses']
		);
		echo json_encode($pesan);
	}

	public function actionUpdateusers()
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

	public function actionDelete(){
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

	