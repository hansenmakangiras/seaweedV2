<?php
	/**
	 * Created by PhpStorm.
	 * User: hanse
	 * Date: 7/19/2016
	 * Time: 9:45 PM
	 */

	class LoginController extends KController
	{
		public function actionIndex()
		{
			$this->layout = '/layouts/singlepage';

			$resp = array();
			$login_status = 'invalid';
			$pesan = '';

			$model = new AdminLoginForm;
			$token = !empty($_POST['token']) ? $_POST['token'] : '';


			$request = Yii::app()->request->getIsPostRequest();
			$ajax = Yii::app()->request->getIsAjaxRequest();
			$model->rememberMe = 0 ;
			if ($request) {

				$username = Yii::app()->request->getPost('username');
				$remember = Yii::app()->request->getPost('rememberMe');

				$resp['submitted_data'] = $_POST;

				$finduser = Users::model()->findByAttributes(array('username' => $username, 'status'=>0));
				if(!$finduser){
					$finduser = Petani::model()->findByAttributes(array('username' => $username, 'status_hapus'=>0));
				}

				if ($finduser) {
					$model->attributes = $_POST;
					if (!empty($remember)) {
						$rememberMe = ($remember === 1) ? 1 : 0;
						$model->rememberMe = $rememberMe;
					}
					if ($model->validate() && $model->login()) {
						$pesan = 'success';
						$login_status = 'success';
					} else {

						if ($model->getError('username')) {

							$pesan = 'Nama pengguna salah';
						} else {
							if ($model->getError('password')) {

								$pesan = 'Kata sandi yang ada masukkan salah';
							}
						}
						$login_status = 'invalid';
					}
				} else {
					$pesan = 'Nama pengguna: ' . $username . ' tidak ditemukan.';
					$login_status = 'invalid';
				}

				$resp['login_status'] = $login_status;

				if ($login_status === 'success') {
					$resp['redirect_url'] = $this->redirect("/kospermindo");
				}

				$resp['pesan'] = $pesan;

				echo CJSON::encode($resp);
				Yii::app()->end();
			}else{
				$this->render('index', array(
					'model' => $model,
					'pesan' => $pesan,
					//'checked' => $checked
				));
			}

		}
	}