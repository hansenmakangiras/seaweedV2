<?php

  class MessageController extends KController
  {
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      $messages = Messages::model()->findAll("sent_status = 0");
      $totaldata = count($messages);
      $this->render('index', array('model' => $messages, 'totaldata' => $totaldata));
    }

    public function actionCreate()
    {
      $pesan = "";
      $request = Yii::app()->request->getIsPostRequest();
      if ($request) {
        if (isset($_POST["Messages"])) {
          //Helper::dd($_POST);
          $token = Pengguna::model()->findByAttributes(array('username' => $_POST["Messages"]["to"]));
          $push_tokens = $token->deviceId;

          $model = new Messages;
          $model->attributes = $_POST["Messages"];
          $model->to = $_POST["Messages"]["to"];
          //$model->subject = $_POST["Messages"]["subject"];
          $model->subject = 'Send Messages To Mobile';
          $model->content = $_POST["Messages"]["content"];

          $model->userid = $token->id;
          $model->from = Yii::app()->user->name;
          $model->is_read = 0;
          $model->is_draft = 0;
          $model->groupid = 1;
          $model->date_send = date("Y-m-d H:i:s");
          $model->date_receive = date("Y-m-d H:i:s");
          $model->tagsid = 2;

          $messageId = Messages::model()->findByAttributes(array('to' => $_POST["Messages"]["to"]));
          $fields = array(
            'jenis_notif' => 'pesan',
            'message' => $_POST["Messages"]["content"],
            'from_user' => (int) Yii::app()->user->id,
            'display_name' => ucfirst(Yii::app()->user->name),
            'message_id' => isset($messageId->id) ? (int) $messageId->id : 0,
          );

          $send = $this->sendNotification(array($push_tokens), $fields);
          $result = CJSON::decode($send);

          if($result['success'] == 1){
            $model->sent_status = $result['success'];
            if ($model->save()) {
              $pesan = "Message Sent";
            } else {
              //Helper::dd($model->errors);
              $pesan = "Message sent failed";
            }
          }elseif($result['failure'] == 0){
            $pesan = 'Gagal Mengirim';
          }
        }
      }
      $this->render('index',
        array('model' => $this->loadModel(), "pesan" => $pesan, 'view' => 'create'));
    }

    public function sendNotification($registrasiId, $message)
    {
      $pesan = '';
      if(isset($registrasiId)){
        if(isset($message)){
          $apiKey = Yii::app()->params['gcm_api_key'];
          $path_to_gmc_server = 'https://android.googleapis.com/gcm/send';

          $fields = array(
            'registration_ids' => $registrasiId,
            'data'             => $message,
          );

          $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json',
          );

          $ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, $path_to_gmc_server);

          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

          $result = curl_exec($ch);
          if ($result === false) {
            //die('Curl failed: ' . curl_error($ch));
            $pesan = 'Curl failed: ' . curl_error($ch);
          }
          curl_close($ch);
          //echo $result;
          return $result;
        }else{
          $pesan = "No Post Message set.";
        }
      }else{
        $pesan = "No registration id found";
      }
      return $pesan;
    }

    public function actionReply()
    {
      $id = isset($id) ? (int)$id : 0;
      if ($id !== 0) {

      }
      $this->render('index', array('model' => $this->loadModel(), 'view' => 'reply'));
    }

    public function actionDraft()
    {
      $messages = Messages::model()->findAll("is_draft = 1");
      $totaldata = count($messages);
      $this->render('index', array(
        'model'     => $messages,
        'totaldata' => $totaldata,
        'view'      => '_draft',
        'tags'      => $this->loadTags(),
      ));
    }

    public function actionAutoComplete(){
      $query = isset($_GET['Messages']['to']) ? $_GET['Messages']['to'] : null;

      $resp = array();

      $resp[] = $query . strrev($query);
      $resp[] = $query . " " . mt_rand(1,99);
      $resp[] = $query . " " . mt_rand(1,99);
      $resp[] = $query . " " . mt_rand(1,99);
      $resp[] = $query . " " . mt_rand(1,99);
      $resp[] = $query . " " . mt_rand(1,99);
      $resp[] = $query . " " . str_shuffle($query);

      echo json_encode($resp);
    }

    public function actionSearch()
    {
      $s = Yii::app()->request->getParam('s');
      if (isset($s)) {
        $data = new Messages("search");
      }
      $messages = Messages::model()->findAll();
      $this->render('index', array('model' => $messages));
    }

    public function actionView()
    {
      $id = Yii::app()->request->getParam("id");
      if (isset($id)) {
        $message = Messages::model()->findByPk($id);
      }
      //$messages = Messages::model()->findAll();

      $this->render('index', array('model' => $message->attributes, 'view' => 'view'));
    }

    public function actionSent()
    {
      $sentMessages = Messages::model()->findAll("sent_status = 1");
      $totaldata = count($sentMessages);
      $this->render('index',
        array('model' => $sentMessages, 'totaldata' => $totaldata, 'view' => '_sent'));
    }

    private function loadTags()
    {
      $tags = MessageTags::model()->findAll();

      return $tags;
    }

    private function loadModel()
    {
      $model = new Messages;

      return $model;
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
      // return the filter configuration for this controller, e.g.:
      return array(
        'inlineFilterName',
        array(
          'class'=>'path.to.FilterClass',
          'propertyName'=>'propertyValue',
        ),
      );
    }

    public function actions()
    {
      // return external action classes, e.g.:
      return array(
        'action1'=>'path.to.ActionClass',
        'action2'=>array(
          'class'=>'path.to.AnotherActionClass',
          'propertyName'=>'propertyValue',
        ),
      );
    }
    */
  }