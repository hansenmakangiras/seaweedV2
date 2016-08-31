<?php
	class LupasandiController extends KController
	{

		/* Set global layout for all actions */
		public $layout = '/layouts/singlepage';

		/**
		 * This is the default 'index' action that is invoked
		 * when an action is not explicitly requested by users.
		 */
		public function actionIndex()
		{
			// renders the view file 'protected/views/login/index.php'
			// using the default layout 'protected/views/layouts/singlepage.php'
			$this->render('index', array());
		}
		public function actionSentEmail(){
			# Response Data Array
			$resp = array();

			// Fields Submitted
			$email = $_POST["email"];

			// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
			$resp['submitted_data'] = 'error';

			echo json_encode($resp);
		}
		
		public function actionSend(){
			$email = !empty($_POST['email']) ? $_POST['email'] : '';
			$pesan = '';
			$isUser = Users::model()->findByAttributes(array('email'=>$email));
			if(isset($_POST['email']) && !empty($isUser)){
				$date = date('Y-m-d');
				$token = md5($isUser['username'].$isUser['password'].$date);
				$mail = Yii::app()->SmtpMail;
				$mail->SetFrom('info@panrita.id', 'Panrita');
				$mail->Subject = 'Terima Kasih Telah Menggunakan Aplikasi Kami';
				$url = Yii::app()->getBaseUrl(true);
				$url_fix = $url.'/kospermindo/lupasandi/gantisandi/'.$isUser['id'].'/'.urlencode($token);
				$msg = "<a href='".$url_fix."'>Klik untuk reset sandi</a> <br> atau silahkan salin url berikut : ".$url_fix."";
				$mail->MsgHTML($msg);
				$mail->AddAddress($email);
				if($mail->Send()){
					Yii::app()->user->setFlash('success', 'Token Berhasil Dikirim di email');
					$pesan = array(
						'message'=>'success'
						);
				}else{
					Yii::app()->user->setFlash('failed', 'email tidak terdaftar');
					$pesan = array(
						'message'=>'failed'
					);
				}
			}else{
				Yii::app()->user->setFlash('failed', 'email tidak terdaftar');	
				$pesan = array(
					'message'=>'failed'
				);
			}
			
			echo json_encode($pesan);
		}

		public function actionGantisandi($id,$token){
			$isUser = Users::model()->findByAttributes(array('id'=>$id));
			if(!empty($isUser)){
				$username = $isUser['username'];
				$password = $isUser['password'];
				$date = date('Y-m-d');
				$isToken = md5($isUser['username'].$isUser['password'].$date);
				$token = urldecode($token);
				if($isToken == $token){
					$id = $isUser['id'];
					$this->render('gantisandi', array('id'=>$id));
				}else{
					Yii::app()->user->setFlash('failed', 'Token tidak sama. silahkan masukkan kembali email anda');
					$this->render('index', array());
				}
			}else{
				Yii::app()->user->setFlash('failed', 'Data User Tidak ditemukan');
				$this->render('index', array());
			}
		}

		public function actionReset(){
			$pesan = '';
			$id = !empty($_POST['id']) ? $_POST['id'] : '';
			$password = !empty($_POST['password']) ? $_POST['password'] : '';

			$isUser = Users::model()->findByAttributes(array('id'=>$id));
			if(!empty($isUser)){
				$isUser->password = CPasswordHelper::hashPassword($password);
				if($isUser->save()){
					Yii::app()->user->setFlash('success', 'Berhasil reset sandi');
					$pesan = array('message'=>'success');
				}else{
					Yii::app()->user->setFlash('failed', 'Token tidak berlaku. silahkan masukkan kembali email anda');
					$pesan = array('message'=>'failed');
				}
			}else{
				Yii::app()->user->setFlash('failed', 'Token tidak berlaku. silahkan masukkan kembali email anda');
				$pesan = array('message'=>'failed');
			}
			echo json_encode($pesan);
		}
	}