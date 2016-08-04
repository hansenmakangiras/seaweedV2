<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 7/19/2016
   * Time: 9:45 PM
   */

  class LoginController extends SController
  {
    public function actionIndex()
    {
      $this->layout = '/layouts/singlepage';
      # Response data array
      $resp = array();
      $login_status = 'invalid';
      $pesan = '';

      $model = new LoginForm();
      $token = !empty($_POST['token']) ? $_POST['token'] : '';

      // Make sure the request is POST.
      $request = Yii::app()->request->getIsPostRequest();
      $ajax = Yii::app()->request->getIsAjaxRequest();
      if ($request) {
        // Fields Submitted Data
        $username = Yii::app()->request->getPost('username');
        $remember = Yii::app()->request->getPost('rememberMe');

        $resp['submitted_data'] = $_POST;

        /* Find user in database */
        $finduser = Users::model()->findByAttributes(array('username' => $username, 'superuser' => 1));

        if ($finduser) {
          $model->attributes = $_POST;
          if (!empty($remember)) {
            $rememberMe = ($remember === 'on') ? 1 : 0;
            $model->rememberMe = $rememberMe;
          }
          if ($model->validate() && $model->login()) {
            $pesan = 'success';
            $login_status = 'success';
          } else {
            //Helper::dd($model->getErrors());
            if ($model->getError('username')) {
              $pesan = $model->getError('username');
            } else {
              if ($model->getError('password')) {
                $pesan = $model->getError('password');
              }
            }
            $login_status = 'invalid';
          }
        } else {
          $pesan = 'Username: ' . $username . ' not found.';
          $login_status = 'invalid';
        }
        $resp['login_status'] = $login_status;

        if ($login_status === 'success') {
          $resp['redirect_url'] = $this->redirect("/superadmin");
        }

        $resp['pesan'] = $pesan;

        echo CJSON::encode($resp);
        Yii::app()->end();
      }else{
        $this->render('index', array(
          'model' => $model,
          'pesan' => $pesan,
        ));
      }

    }
  }