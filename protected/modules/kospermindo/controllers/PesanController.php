<?php

  class PesanController extends KController
  {
//    public $defaultAction = 'inbox';
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      $messagesAdapter = Messages::model()->getAdapterForInbox(Yii::app()->user->getId());
      $pager = new CPagination($messagesAdapter->getTotalItemCount(true));
      $pager->pageSize = 10;
      $messagesAdapter->setPagination($pager);

      $messages = Messages::model()->byDate()->findAll("sent_status = 0");
      $gudang = Gudang::model()->findAllByAttributes(array('status' => 0), array('order' => 'kode_jenis_gudang'));
      $totaldata = count($messages);
      $this->render('index', array(
        'model' => $messages,
        'totaldata' => $totaldata,
        'gudang' => $gudang,
        'messagesAdapter' => $messagesAdapter
      ));
    }

    public function actionCreate()
    {
      $pesan = "";
      $request = Yii::app()->request->getIsPostRequest();
      if ($request) {
        if (isset($_POST['Messages'])) {
          $postMessage = $_POST['Messages'];
          Helper::dd($_POST);
          $token = Petani::model()->findByAttributes(array('username' => $_POST['Messages']['to']));
          $push_tokens = isset($token->device_id) ? $token->device_id : null;

          $model = new Messages;
          $model->attributes = $postMessage;
          $model->sender_id = Yii::app()->user->id;
          $model->receiver_id = $postMessage['to'];
          $model->to = Petani::model()->getUserName($postMessage['to']);
          $model->from = Yii::app()->user->name;
          $model->content = $postMessage['content'];

//          $model->userid = isset(Yii::app()->user->id) ? (int)Yii::app()->user->id : 3;
//          $model->from = Yii::app()->user->name;
//          $model->to_userid = $token->id_petani;
//          $model->is_read = 0;
//          $model->is_draft = 0;
//          $model->roomid = 1;
//          $model->kode_kelompok = $token->kode_kelompok;
//          $model->kode_gudang = $token->kode_gudang;
//          $model->date_send = date("Y-m-d H:i:s");
//          $model->date_receive = date("Y-m-d H:i:s");
//          $model->sent_status = 1;
          if ($model->save()) {
            $sql = "SELECT * FROM messages WHERE `to` = '" . $_POST['Messages']['to'] . "' ORDER BY date_send DESC LIMIT 1";
            $messageId = Messages::model()->findBySql($sql);
            $fields = array(
              'jenis_notif'  => 'pesan',
              'message'      => $_POST["Messages"]["content"],
              'from_user'    => (int)Yii::app()->user->id,
              'display_name' => isset(Yii::app()->user->id) ? 'Admin' : 'Guest',
              'message_id'   => (int)$messageId->id,
            );

            $send = $this->sendNotification(array($push_tokens), $fields);
            $result = CJSON::decode($send);

            if ($result['success'] === 1) {
              Yii::app()->user->setFlash('success', 'Pesan anda telah berhasil terkirim');
              $pesan = "Message Sent";
            } elseif ($result['failure'] === 0) {
              Yii::app()->user->setFlash('error', 'Tidak dapat mengirim ke server');
//              $pesan = 'Gagal Mengirim';
            }
          } else {
            //Helper::dd($model->errors);
            Yii::app()->user->setFlash('error', 'Tidak dapat menyimpan ke database');
            $pesan = "Message sent failed";
          }
          //Helper::dd($messageId);
        }
      }
      $this->render('index', array(
        'model' => $this->loadModel(),
        'pesan' => $pesan,
        'view'  => 'create',
      ));
    }

    public function sendNotification($registrasiId, $message)
    {
      $pesan = '';
      if (isset($registrasiId)) {
        if (isset($message)) {
          $apiKey = Yii::app()->params['gcm_api_key'];
          $url_to_gcm_server = 'https://android.googleapis.com/gcm/send';

          $fields = array(
            'registration_ids' => $registrasiId,
            'data'             => $message,
          );

          $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json',
          );

          $ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, $url_to_gcm_server);

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
        } else {
          $pesan = "No Post Message set.";
        }
      } else {
        $pesan = "No registration id found";
      }

      return $pesan;
    }

    private function loadModel()
    {
      $model = new Messages;

      return $model;
    }

    public function actionSetPetani()
    {
      $id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
      $idKelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '';
      $idPetani = !empty($_POST['id_petani']) ? $_POST['id_petani'] : '';

      Yii::app()->user->setFlash('id_kelompok', $idKelompok);
      Yii::app()->user->setFlash('id_petani', $idPetani);
      Yii::app()->user->setFlash('id_gudang', $id_gudang);

      $pesan = array('message' => 'success');
//      Helper::dd($id_gudang);
      echo json_encode($pesan);
    }

    public function actionGetgudang()
    {
      $id = !empty($_POST['id']) ? $_POST['id'] : '';
      $gudang = Gudang::model()->findAllByAttributes(array('kode_jenis_gudang' => $id, 'status' => 0));
      $arrGudang = array();
      foreach ($gudang as $key => $value) {
        $arr = array('id' => $value->kode_gudang, 'value' => $value->nama);
        array_push($arrGudang, $arr);
      };
      echo json_encode($arrGudang);
    }

    public function actionGetpetani(){
      $id_gudang = !empty($_POST['id_gudang']) ? $_POST['id_gudang'] : '';
      $id_kelompok = !empty($_POST['id_kelompok']) ? $_POST['id_kelompok'] : '';

      $gudang = Gudang::model()->findByAttributes(array('id_gudang'=>$id_gudang));
      $kelompok = Kelompok::model()->findByAttributes(array('id_kelompok'=>$id_kelompok));
//      Helper::dd($gudang);

      $getPetani = Petani::model()->findAllByAttributes(array('kode_gudang'=> $gudang->kode_gudang,'kode_kelompok'=>$kelompok->kode_kelompok, 'status_hapus'=>0));
      $arrPetani = array();
      foreach ($getPetani as $key => $value) {
        $arr = array('id'=>$value->id_petani, 'value'=>$value->nama_petani);
        array_push($arrPetani, $arr);
      };
      echo json_encode($arrPetani);
    }

    public function actionGetKelompok()
    {
      $id = !empty($_POST['id']) ? $_POST['id'] : '';
      $getKel = Kelompok::model()->findAllByAttributes(array('kode_gudang' => $id, 'status' => 0));
      $arrKel = array();
      foreach ($getKel as $key => $value) {
        $arr = array('id' => $value->kode_kelompok, 'value' => $value->nama_kelompok);
        array_push($arrKel, $arr);
      };
      echo json_encode($arrKel);
    }

    public function actionBuat()
    {
      $pesan = "";
      $request = Yii::app()->request->getIsPostRequest();

      if ($request && count($_POST['Messages']) !== 0) {
        /* Set Variable */
        $postMessage = $_POST['Messages'];
        $kodeGudang = array_key_exists('kode_gudang', $postMessage) ? $postMessage['kode_gudang'] : '';
        $kodeKelompok = array_key_exists('kode_kelompok', $postMessage) ? $postMessage['kode_kelompok'] : '';
        $to = array_key_exists('to', $postMessage) ? $postMessage['to'] : '';
        $content = array_key_exists('content', $postMessage) ? $postMessage['content'] : '';
        $model = new Message;

        $crit = new CDbCriteria();
        if(null !== $to || $to !== ''){
          $petani = Petani::model()->findByPk((int) $to);
          $push_tokens = isset($petani->device_id) ? $petani->device_id : null;
          $data = array();
          $exist = Message::model()->exists('id_petani = :id' ,array('id' => (int) $to));
          $model->setScenario('create');
          $model->attributes = $postMessage;

          if(null !== $petani){
            if(!$exist){
              $model->id_petani = (int) $to;
              $content = array(
                'from' => 1,
                'pesan' => $content,
                'date' => date('Y-m-d H:i:s'),
                'status' => 0,
                'read' => 0,
              );
              $model->content = CJSON::encode(array($content));

              if($model->save()){
//                  $sql = "SELECT * FROM messages WHERE `to` = '" . $to . "' ORDER BY date_send DESC LIMIT 1";
//                  $messageId = Messages::model()->findBySql($sql);
//                  $fields = array(
//                    'jenis_notif'  => 'pesan',
//                    'message'      => $_POST["Messages"]["content"],
//                    'from_user'    => (int)Yii::app()->user->id,
//                    'display_name' => isset(Yii::app()->user->id) ? 'Admin' : 'Guest',
//                    'message_id'   => (int)$messageId->id,
//                  );
//
//                  $send = $this->sendNotification(array($push_tokens), $fields);
//                  $result = CJSON::decode($send);

                //if ($result['success'] === 1) {
                //Yii::app()->user->setFlash('success', 'Pesan anda telah berhasil terkirim');
                //$pesan = "Message Sent";
                //} elseif ($result['failure'] === 0) {
                //Yii::app()->user->setFlash('error', 'Tidak dapat mengirim ke server');
//              $pesan = 'Gagal Mengirim';
                //}
                //} else {
                //Helper::dd($model->getErrors());
                //Yii::app()->user->setFlash('error', 'Tidak dapat menyimpan ke database');
//            $pesan = "Message sent failed";
                //}
                Yii::app()->user->setFlash('success', 'Pesan anda telah berhasil terkirim');
                $pesan = 'Message Sent';
              }else{
//                  Helper::dd($model->getErrors());
                Yii::app()->user->setFlash('error', 'Tidak dapat mengirim ke server');
                $pesan = 'Gagal Mengirim';
              }
            }else{
              $message = Message::model()->findByAttributes(array('id_petani' => $to));
              $msgContent = CJSON::decode($message->content);
              //Helper::dd($msgContent);
              $content = array(
                'from' => 0,
                'pesan' => $content,
                'date' => date('Y-m-d H:i:s'),
                'status' => 1,
                'read' => 0,
              );
              $arrData = array();
              $msgContent[] = $content;
//                array_push($msgContent,$content);
              $model->id_petani = (int) $to;
              $message->content = CJSON::encode($msgContent);
              if($message->save()){
                Yii::app()->user->setFlash('success', 'Pesan anda telah berhasil terkirim');
                $pesan = "Message Sent";
              }else{
                Helper::dd($message->getErrors());
                Yii::app()->user->setFlash('error', 'Tidak dapat mengirim ke server');
                $pesan = 'Gagal Mengirim';
              }
            }
          }

        }elseif (null !== $kodeKelompok || $kodeKelompok !== ''){
          $gudang = Gudang::model()->findByAttributes(array('kode_gudang' => $kodeGudang));
          $kelompok = Kelompok::model()->findAllByAttributes(array('kode_gudang' => $kodeGudang));
          $allPetaniInGudang = Petani::model()->findAllByAttributes(array('kode_gudang' => $gudang->kode_gudang));
          $petani = array();
          foreach ($allPetaniInGudang as $item) {
            $petani[] = $item->id_petani;
          }
          $group = Yii::app()->getModule('kospermindo')->openGroup($petani);
          Helper::dd($group);
          Yii::app()->user->setFlash('error', 'Sedang dalam pengembangan');
        }else{
          $gudang = Gudang::model()->findByAttributes(array('kode_gudang' => $kodeGudang));
          $allPetaniInGudang = Petani::model()->findAllByAttributes(array('kode_gudang' => $gudang->kode_gudang));
          $petani = array();
          foreach ($allPetaniInGudang as $item) {
            $petani[] = $item->id_petani;
          }
          $group = Yii::app()->getModule('kospermindo')->openGroup($petani);
          Helper::dd($group);
          Yii::app()->user->setFlash('error', 'Sedang dalam pengembangan');
//            $crit->addCondition('kode_gudang = :kode');
//            $crit->params = array('kode' => $kodeGudang);
//            $crit->addCondition('kode_gudang = :kode');
//            $crit->params = array('kode' => $kodeGudang);
//            $crit->addCondition('kode_gudang = :kode');
//            $crit->params = array('kode' => $kodeGudang);
//
//            $petani = Petani::model()->findAll($crit);
//            $data = array();
//            if(count($petani) !== 0){
//              $model->attributes = $postMessage;
//              foreach ($petani as $key => $item) {
//                $data[$key]['userid'] = $item->id_petani;
//                $data[$key]['pesan'] = $content;
//                $data[$key]['date'] = date('Y-m-d H:i:s');
//                $data[$key]['status'] = 0;
//                $data[$key]['read'] = 0;
//                $data[$key]['id_petani'] = $item->id_petani;
//                $model->id_petani = $item->id_petani;
//              }
//              $model->content = CJSON::encode($data);
//              if($model->save()){
//                Yii::app()->user->setFlash('success', 'Pesan anda telah berhasil terkirim');
//                $pesan = "Message Sent";
//              }else{
//                Helper::dd($model->getErrors());
//                Yii::app()->user->setFlash('error', 'Tidak dapat mengirim ke server');
//                $pesan = 'Gagal Mengirim';
//              }
//            }
        }

//          $token = Petani::model()->findByAttributes(array('id_petani' => (int)$to));
//          $push_tokens = isset($token->device_id) ? $token->device_id : null;
//          Helper::dd($token);
//          $message = Messages::model()->with('from_user','to_user')->findByPk(1);
//          $fromUser = $message->from_user;
//          $toUser = $message->to_user;
//          Helper::dd($message);
//          Helper::dd($fromUser);
//          Helper::dd($toUser);

//          $content = array(
//            'id' => $postMessage['to'],
//            'pesan' => $postMessage['content'],
//            'status' => 0,
//            'read' => 0,
//            'date' => date('Y-m-d H:i:s')
//          );
//
//          $model = new Message;
//          $model->attributes = $postMessage;
//          $model->id_petani = $postMessage['to'];
//          $model->content = CJSON::encode($content);

//          $model = new Messages;
//          $model->attributes = $_POST['Messages'];
//          $model->to = $token->username;
//          $model->kode_jenis_gudang = $token->kode_jenis_gudang;
//          $model->content = $_POST['Messages']['content'];
//          $model->userid = isset(Yii::app()->user->id) ? (int)Yii::app()->user->id : 3;
//          $model->from = Yii::app()->user->name;
//          $model->to_userid = $token->id_petani;
//          $model->is_read = 0;
//          $model->is_draft = 0;
//          $model->roomid = 1;
//          $model->kode_kelompok = $token->kode_kelompok;
//          $model->kode_gudang = $token->kode_gudang;
//          $model->date_send = date('Y-m-d H:i:s');
//          $model->date_receive = date('Y-m-d H:i:s');
//          $model->sent_status = 1;

        //$model->content = CJSON::encode($content);
        //if ($model->save()) {
//            $sql = "SELECT * FROM messages WHERE `to` = '" . $_POST["Messages"]["to"] . "' ORDER BY date_send DESC LIMIT 1";
//            $messageId = Messages::model()->findBySql($sql);
//            $fields = array(
//              'jenis_notif'  => 'pesan',
//              'message'      => $_POST["Messages"]["content"],
//              'from_user'    => (int)Yii::app()->user->id,
//              'display_name' => isset(Yii::app()->user->id) ? 'Admin' : 'Guest',
//              'message_id'   => (int)$messageId->id,
//            );

//            $send = $this->sendNotification(array($push_tokens), $fields);
//            $result = CJSON::decode($send);

        //if ($result['success'] === 1) {
        //Yii::app()->user->setFlash('success', 'Pesan anda telah berhasil terkirim');
        //$pesan = "Message Sent";
        //} elseif ($result['failure'] === 0) {
        //Yii::app()->user->setFlash('error', 'Tidak dapat mengirim ke server');
//              $pesan = 'Gagal Mengirim';
        //}
        //} else {
        //Helper::dd($model->getErrors());
        //Yii::app()->user->setFlash('error', 'Tidak dapat menyimpan ke database');
//            $pesan = "Message sent failed";
        //}
        //Helper::dd($messageId);
      }
      //        else{
//          if ($id) {
//            $receiver = call_user_func(array(call_user_func(array(Messages::model()->userModel, 'model')), 'findByPk'), $id);
//            if ($receiver) {
//              $receiverName = call_user_func(array($receiver, Yii::app()->getNameMethod));
//              $model->receiver_id = $receiver->id;
//            }
//          }
//        }
      $this->render('index', array(
        'model'     => $this->loadModel(),
        'pesan'     => $pesan,
        'view'      => 'create',
      ));
    }

    public function actionBalas()
    {
      $id = Yii::app()->request->getParam('id');
      $id = isset($id) ? (int)$id : 0;
      $pesan = '';
      $messageId = Messages::model()->findByPk($id);
      //Helper::dd($_POST['Messages']);
      if (isset($_POST['Messages'])) {
        $token = Petani::model()->findByAttributes(array('username' => $_POST['Messages']['to']));
        $push_tokens = $token->device_id;

        $model = new Messages;
        $model->attributes = $_POST["Messages"];
        $model->to = $messageId->to;
        $model->subject = 'Send Messages To Mobile';
        $model->content = $_POST["Messages"]["content"];

        $model->userid = Yii::app()->user->id;
        $model->to_userid = $token->id_petani;
        $model->from = Yii::app()->user->name;
        $model->is_read = 1;
        $model->kode_kelompok = $token->kode_kelompok;
        $model->kode_gudang = $token->kode_gudang;
        $model->date_send = date("Y-m-d H:i:s");
        $model->date_receive = date("Y-m-d H:i:s");

        //$messageId = Messages::model()->findByAttributes(array('to' => $messageId->to));
        $fields = array(
          'jenis_notif'  => 'pesan',
          'message'      => $_POST["Messages"]["content"],
          'from_user'    => (int)Yii::app()->user->id,
          'display_name' => isset(Yii::app()->user->id) ? 'Admin' : 'Guest',
          'message_id'   => isset($messageId->id) ? (int)$messageId->id : 0,
        );

        $send = $this->sendNotification(array($push_tokens), $fields);
        $result = CJSON::decode($send);

        if ($result['success'] == 1) {
          $model->sent_status = isset($result['success']) ? $result['success'] : 1;
          if ($model->save()) {
            Yii::app()->user->setFlash('success', 'Message Sent Successfully');
            $pesan = "Message Sent";
          } else {
            $model->is_draft = 1;
            Helper::dd($model->getErrors());
            Yii::app()->user->setFlash('error', 'Message Sent Successfully');
            $pesan = "Pesan tidak tersimpan";
          }
        } elseif ($result['failure'] == 0) {
          Yii::app()->user->setFlash('error', 'Message Sent Successfully');
          $pesan = 'Gagal Mengirim Pesan';
        }
      }
      $this->render('index', array('model' => $messageId, 'view' => '_reply', 'pesan' => $pesan));
    }

    public function actionSimpan()
    {
      $messages = Messages::model()->findAll("is_draft = 1");
      $totaldata = count($messages);
      $this->render('index', array(
        'model'     => $messages,
        'totaldata' => $totaldata,
        'view'      => '_draft',
      ));
    }

    public function actionCari()
    {
      $s = Yii::app()->request->getParam('s');
      if (isset($s)) {
        $data = new Messages("search");
      }
      $messages = Messages::model()->findAll();
      $this->render('index', array('model' => $messages));
    }

    public function actionLihat()
    {
      $id = Yii::app()->request->getParam("id");
      if (isset($id)) {
        //$message = Messages::model()->findAllByAttributes(array('userid' => $id,'sent_status'=>1));
        $message = Messages::model()->findByPk($id);
      }
      //$messages = Messages::model()->findAll();

      $this->render('index', array('model' => $message, 'view' => 'view'));
    }

    public function actionKeluar()
    {
      $sentMessages = Messages::model()->byDate()->findAll("sent_status = 1");
      $totaldata = count($sentMessages);
      $this->render('index',
        array('model' => $sentMessages, 'totaldata' => $totaldata, 'view' => '_sent'));
    }

    public function actionGetCountAllMessages()
    {
      $post = Yii::app()->request->getIsPostRequest();
      $ajaxRequest = Yii::app()->request->getIsAjaxRequest();
      $tipe = Yii::app()->request->getPost('tipe');
      if ($post && $ajaxRequest) {
        $readMsg = Kospermindo::getCountUnreadMessages();
        $sentMsg = Kospermindo::getSentMessageStatus();
        $draftMsg = Kospermindo::getCountDraft();

        $data = array('inbox' => $readMsg, 'sent' => $sentMsg, 'draft' => $draftMsg);
        echo CJSON::encode($data);
      } else {
        echo CJSON::encode(array('message' => 'Your request is not valid'));
      }
    }

    public function actionGetAllKelompok()
    {
      $post = Yii::app()->request->getIsPostRequest();
      $ajaxRequest = Yii::app()->request->getIsAjaxRequest();
      $kodeGudang = Yii::app()->request->getPost('kode_jenis_gudang');
      if ($post && $ajaxRequest) {
        //Helper::dd($kodeGudang);
        $model = Kelompok::model()->getListKelompokByGudang($kodeGudang);

        //$data = array('inbox' => $readMsg,'sent' => $sentMsg,'draft' => $draftMsg);
        echo CJSON::encode($model);
      } else {
        echo CJSON::encode(array('message' => 'Your request is not valid'));
      }
    }
  }