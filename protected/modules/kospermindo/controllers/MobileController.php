<?php

  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 6/21/2016
   * Time: 1:32 AM
   */
  class MobileController extends KController
  {
    private $_useragent;
    private $_dataMobile;
    private $userAuth;
    public function init()
    {
      Helper::setTimeZone('Asia/Makassar');
      $this->layout = false;
      header('Content-type: application/json');
      $this->userAuth = isset($_POST['UserAuth']) ? $_POST['UserAuth'] : array();
      $this->_useragent = Yii::app()->request->getPost('useragent');
      $this->_useragent = !empty($this->_useragent) ? $this->_useragent : "";
      $this->_dataMobile = (isset($_POST['data-mobile']) ? $_POST['data-mobile'] : '');
    }

    public function actionGetRegistrationId()
    {
      $userAuth = $_POST['UserAuth'];
      $pesan = '';
      $error = 0;
      $postRequest = Yii::app()->request->getIsPostRequest();
      if ($postRequest) {
        //if ($this->_useragent === 'Mobile-Panrita') {
          if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
            if (isset($userAuth)) {
              //echo CJSON::encode($userAuth);
              $registrationId = $userAuth['deviceID'];
              $userid = $userAuth['userid'];

              $users = Pengguna::model()->findByPk($userid);
              if ($users) {
                if(!empty($users->deviceId)){
                  $users->setScenario('update');
                  $users->deviceId = $registrationId;
                }else{
                  $users->setScenario('insert');
                  $users->deviceId = $registrationId;
                }
                $users->saveAttributes(array('deviceId'));
                $pesan = 'success';
                $error = 0;
              } else {
                $pesan = 'User not found';
                $error = 2;
              }
            } else {
              $pesan = 'No DeviceID found';
              $error = 3;
            }
          }
        //}
      }
      /*Generate data to JSON */
      $jsonData['UserAuth'] = array(
        'pesan' => $pesan,
        'error' => $error,
      );

      echo CJSON::encode($jsonData);
      Yii::app()->end();
    }

    public function actionGetListContact(){
      $users = array();
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        $users = Pengguna::model()->getUserProfiles();
      }

      /*Generate data to JSON */
      $jsonData['ListContact'] = array(
        'petani' => $users,
        //'error' => $error,
      );

      echo CJSON::encode($jsonData);
      Yii::app()->end();
      //}
    }

    public function actionGetLogin()
    {
      $model = new MobileLoginForm;
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        if (isset($_POST['User'])) {
          $username = !empty($_POST['User']['username']) ? filter_var($_POST['User']['username'],
            FILTER_SANITIZE_STRING) : "";

          $findpengguna = Pengguna::model()->findByAttributes(array('username' => $username));
          if ($findpengguna['username'] === $username) {
            $model->attributes = $_POST['User'];
            if ($model->validate() && $model->login()) {
              $sess = $findpengguna['username'];
              $iduser = $findpengguna['id'];
              $message = 'success';
              $error = 0;
            } else {
              $sess = $findpengguna['username'];
              $iduser = $findpengguna['id'];
              $message = 'failed';
              $error = 1;
            }
          } else {
            $sess = null;
            $iduser = null;
            $message = 'Username not found';
            $error = 2;
          }
          /*Generate data to JSON */
          $jsonData['panrita'] = array(
            'username' => $sess,
            'userid'   => (int) $iduser,
            'pesan'    => $message,
            'error'    => $error,
          );
          echo CJSON::encode($jsonData);
          Yii::app()->end();
        }
      }
      //}else {
      //$this->redirect("/");
      //}
    }

    public function actionGetConfig()
    {
      $tipe = KomoditiType::model()->findAll();
      $data = array();
      foreach ($tipe as $key => $value){
        $data[$key]['id'] = (int) $value['id'];
        $data[$key]['name'] = $value['type'];
      }

      $moderatorConfig = array('phone' => '08134543454', 'name' => 'Anwar', 'level' => 'Moderator');
      $adminConfig = array('phone' => '08114199010', 'name' => 'Hansen', 'level' => 'Admin');
      $helpDesk = "";
      if(isset($_POST['UserAuth']['userid'])){
        $pengguna = Pengguna::model()->findAllByAttributes(array('id' => $_POST['UserAuth']['userid'],'is_moderator' => 1));
        if($pengguna){
          $helpDesk = array($adminConfig, $moderatorConfig);
        }else{
          $helpDesk = array($adminConfig);
        }
      }else{
        $helpDesk = array($adminConfig);
      }
      //if($this->_useragent === 'Mobile-Panrita') {
      //if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        $jsonData['panrita_config'] = array('jenis_seaweed' => $data, 'help_phone' => $helpDesk);
        echo CJSON::encode($jsonData);
      //}
      //}else {
      //$this->redirect("/");
      //}
    }

    public function actionInsertSeaweed()
    {
      $seaweed = new Komoditi;
      $pesan = "";
      $error = 1;
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        if (isset($_POST['Data'])) {
          $username = Pengguna::model()->findByPk($_POST['Data']['userid']);
          if ($username) {
            $seaweed->attributes = $_POST['Data'];
            $seaweed->id_user = $username->id;
            $seaweed->id_komoditi = $_POST['Data']['id_seaweed'];
            $seaweed->nama_komoditi = KomoditiType::model()->trKomoditiTipe((int) $_POST['Data']['id_seaweed']);
            $seaweed->kadar_air = Helper::_format_number($_POST['Data']['kadar_air']);
            $seaweed->jumlah_bentangan = 0;
            $seaweed->total_panen = Helper::_format_number($_POST['Data']['total_panen']);
            $seaweed->created_by = isset($username->username) ? $username->username : Yii::app()->user->getName();
            if ($seaweed->save()) {
              $pesan = 'Success';
              $error = 0;
            } else {
              $pesan = 'Failed';
              //$error = 1;
            }
          } else {
            $pesan = 'User not found';
            $error = 2;
          }
        }
        $jsonData['panrita_insert'] = array('message' => $pesan, 'error' => $error);
        echo CJSON::encode($jsonData);
      }
      //}else {
      //$this->redirect("/");
      //}
    }

    public function actionListContact()
    {
      $contact = Pengguna::model()->findAll('levelid = 3');
      $data = array();
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        if (!empty($contact)) {
          $fields = array(
            'username' => '',
            'userid' => 0,
            'phone_number' => '',
            'display_name' => '',
          );
          foreach ($contact as $value) {
            $data[] = $value->attributes['username'];
          }
        }
        $jsonData['panrita_contact'] = array('data' => $data, 'totaldata' => count($data));
        echo CJSON::encode($jsonData);
      }
      //}else {
      //$this->redirect("/");
      //}
    }

    public function actionGetMessage()
    {
      $pesan = '';
      $error = 0;
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        $criteria = new CDbCriteria;
        $criteria->condition = array('order' => 'date_send DESC');

        $messages = Messages::model()->byDate()->findAllByAttributes(array('to' => 'nuarz'));
        $total = count($messages);
        $fields = array();
        foreach ($messages as $key => $message) {
          $fields[$key]['subject'] = $message['subject'];
          $fields[$key]['last_message'] = $message['subject'];
          $fields[$key]['last_sender'] = array(
            array('display_name' => $message['subject'], 'username' => $message['subject']),
            array('display_name' => $message['subject'], 'username' => $message['subject']),
          );
          $fields[$key]['userid'] = $message['userid'];
          $fields[$key]['last_time'] = $message['userid'];
          $fields[$key]['status'] = 'Sent Or Not';
          $fields[$key]['status'] = 'Sent Or Not';
        }

//        $fields = array(
//          'username' => '',
//          'userid' => 0,
//          'last_message' => '',
//          'last_sender' => array(
//            array('display_name' => ''),
//            array('userid' => 0),
//            array('username' => ''),
//          ),
//          'last_time' => '',
//          ''
//        );

        $jsonData['result'] = array('data' => $fields, 'totaldata'=>$total);
        echo CJSON::encode($jsonData);
      }
      //}else {
      //$this->redirect("/");
      //}

    }
  }