<?php

  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 6/21/2016
   * Time: 1:32 AM
   */
  class MobileController extends KController
  {
    public $sent_status;
    public $is_read;
    public $error;
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
      $this->_dataMobile = isset($_POST['data-mobile']) ? $_POST['data-mobile'] : '';
      $this->sent_status = isset($_POST['sent_status']) ? $_POST['sent_status'] : false;
      $this->is_read = isset($_POST['is_read']) ? $_POST['is_read'] : false;
    }

    public function actionGetRegistrationId()
    {
      $userAuth = $this->userAuth;
      $pesan = '';
      $error = 0;
      $postRequest = Yii::app()->request->getIsPostRequest();
      if ($postRequest) {
        //if ($this->_useragent === 'Mobile-Panrita') {
        if ($this->_dataMobile !== '' && $this->_dataMobile === 'panritaid') {
          if (isset($userAuth)) {
            //echo CJSON::encode($userAuth);
            $registrationId = $userAuth['deviceID'];
            $userid = $userAuth['userid'];

            $users = Petani::model()->findByPk($userid);
            if ($users) {
              if (!empty($users->device_id)) {
                $users->setScenario('update');
                $users->device_id = $registrationId;
              } else {
                $users->setScenario('insert');
                $users->device_id = $registrationId;
              }
              $users->saveAttributes(array('device_id'));
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

    public function actionLogout()
    {
      $log = Yii::app()->user->logout(false);
      $message = '';
      $error = 0;
      if ($log) {
        $message = "Success";
      } else {
        $error = 1;
        $message = "Failed";
      }
      echo CJSON::encode(array('message' => $message, 'error' => $error));
    }

    public function actionGetInfoHarga()
    {
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        $modelHarga = HargaSeaweed::model()->findAll('status = :status', array(':status' => 0));
        $arrHarga = array();
        if (null !== $modelHarga || count($modelHarga) !== 0) {
          foreach ($modelHarga as $key => $item) {
            $arrHarga[$key]['id_komoditi'] = (int) $item->id_jenis_komoditi;
            $arrHarga[$key]['nama_komoditi'] = JenisKomoditi::model()->getJenisKomoditiharga((int) $item->id_jenis_komoditi);
            $arrHarga[$key]['harga'] = $item->harga;
          }
          echo CJSON::encode(array('Panrita_Info_Harga' => $arrHarga));
        }
      }
      //}
    }

    public function actionGetLogin()
    {
      $model = new MobileLoginForm();
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        if (isset($_POST['UserAuth'])) {
          $username = !empty($_POST['UserAuth']['username']) ? filter_var($_POST['UserAuth']['username'],
            FILTER_SANITIZE_STRING) : "";
          $jenisKomoditi = array();
          $userData = array();
          $arrJenis = array();
          $findpengguna = Petani::model()->findByAttributes(array('username' => $username));
          $admin = Users::model()->findByAttributes(array('id' => $findpengguna->id_perusahaan));
          $moderatorConfig = array('phone' => '08134543454', 'name' => 'Anwar', 'level' => 'Moderator');
          $adminConfig = array('phone' => $admin->no_handphone, 'name' => $admin->username, 'level' => 'Admin');

          if ($findpengguna->username === $username) {
            $model->attributes = $this->userAuth;
            if ($model->validate() && $model->login()) {
              $sess = $findpengguna->username;
              $iduser = $findpengguna->id_petani;
              $jnsKomoditi = json_decode($findpengguna->jenis_komoditi);

              //$userKomoditi = $findpengguna->jenis_komoditi;
              //$userKomoditi = array_filter(explode(',', $userKomoditi));
              $modelGudang = Gudang::model()->findByAttributes(array('kode_gudang' => $findpengguna->kode_gudang));
              $modelKelompok = Kelompok::model()->findByAttributes(array('kode_kelompok' => $findpengguna->kode_kelompok));
              $userData = array(
                'telepon'       => $findpengguna->no_telp,
                'display_name'  => $findpengguna->nama_petani,
                'lokasi_gudang' => array(
                  'nama_gudang'      => $modelGudang->nama,
                  'alamat'           => $modelGudang->alamat,
                  'latitude'         => $modelGudang->latitude,
                  'longitude'        => $modelGudang->longitude,
                  'penanggung_jawab' => !empty($modelGudang->koordinator) ? $modelGudang->koordinator : "Koordinator belum dipilih",
                ),
                'kelompok'      => !empty($modelKelompok->nama_kelompok) ? $modelKelompok->nama_kelompok : "Belum masuk dalam kelompok manapun",
              );
              //Helper::dd($jnsKomoditi);
              foreach ($jnsKomoditi as $key => $value) {
                if (null !== $value || count($value) !== 0) {
                  $jenisKomoditi[$key]['id'] = (int) $value->id;
                  $jenisKomoditi[$key]['nama'] = JenisKomoditi::model()->getJenisKomoditiharga($value->id);
                }
              }
              $message = 'success';
              $error = 0;
            } else {
              $sess = $findpengguna->username;
              $iduser = $findpengguna->id_petani;
              $message = 'failed';
              $error = 1;
            }
          } else {
            $sess = null;
            $iduser = null;
            $message = 'Username not found';
            $error = 2;
          }
          if($error === 0){
            $config = array(
              'jenis_seaweed' => $jenisKomoditi,
              'help_desk'     => array(/*$moderatorConfig,*/
                $adminConfig,
              ),
              'user_data'     => $userData,
            );
          }else{
            $config = '';
          }

          /*Generate data to JSON */
          $jsonData['panrita'] = array(
            'config' => $config,
            'username' => $sess,
            'userid'   => (int)$iduser,
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
      $petani = Petani::model()->findByAttributes(array(
        'id_petani'    => $_POST['UserAuth']['userid'],
        'status_hapus' => 0,
      ));
      $admin = Users::model()->findByAttributes(array('id' => $petani->id_perusahaan));
      $moderatorConfig = array('phone' => '08134543454', 'name' => 'Anwar', 'level' => 'Moderator');
      $adminConfig = array('phone' => $admin->no_handphone, 'name' => $admin->username, 'level' => 'Admin');

      $jnsKomoditi = json_decode($petani->jenis_komoditi);
      $arrJenis = array();

      foreach ($jnsKomoditi as $value) {
        if (null !== $value || count($value) !== 0) {
          $jenis = JenisKomoditi::model()->findByAttributes(array('id_komoditi' => $value->id, 'status' => 0));
          $arr = array();
          if ($jenis) {
            $arr = array('id' => (int)$jenis->id_komoditi, 'name' => ucfirst($jenis->jenis));
          }
          $arrJenis[] = $arr;
        }
      }

      $helpDesk = "";

      if (isset($this->userAuth['userid'])) {
        $pengguna = Petani::model()->findAllByAttributes(array('id_petani' => $this->userAuth['userid']));
        if ($pengguna) {
          $helpDesk = array($adminConfig/*, $moderatorConfig*/);
        } else {
          $helpDesk = array($adminConfig);
        }
      } else {
        $helpDesk = array($adminConfig);
      }
      //if($this->_useragent === 'Mobile-Panrita') {
      //if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
      $jsonData['panrita_config'] = array('jenis_seaweed' => $arrJenis, 'help_phone' => $helpDesk);
      echo CJSON::encode($jsonData);
      //}
      //}else {
      //$this->redirect("/");
      //}
    }

    public function actionEditSeaweed()
    {
      $id = !empty($_POST['Data']['id_report']) ? $_POST['Data']['id_report'] : null;
      $pesan = "";
      $error = 1;
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        if (isset($_POST['Data'])) {
          $seaweed = Seaweed::model()->findByPk((int)$id);
          if ($seaweed !== null || $seaweed > 0) {
            $seaweed->attributes = $_POST['Data'];
            //$seaweed->id_seaweed = $_POST['Data']['id_seaweed'];
            $seaweed->kadar_air = Helper::_format_number($_POST['Data']['kadar_air']);
            $seaweed->total_panen = Helper::_format_number($_POST['Data']['total_panen']);
            if ($seaweed->save()) {
              $pesan = 'Success';
              $error = 0;
            } else {
              $pesan = 'Failed';
              $error = 1;
            }
          } else {
            $pesan = 'ID report tidak ditemukan';
            $error = 1;
          }
        }
        $jsonData['panrita_edit'] = array('message' => $pesan, 'error' => $error);
        echo CJSON::encode($jsonData);
      }
    }

    public function actionInsertSeaweed()
    {
      $seaweed = new Seaweed;
      $pesan = "";
      $error = 1;
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        if (isset($_POST['Data'])) {
          $username = Petani::model()->findByPk($_POST['Data']['userid']);
          $gudang = Gudang::model()->findByAttributes(array('kode_gudang' => $username->kode_gudang));
          $kelompok = Kelompok::model()->findByAttributes(array('kode_kelompok' => $username->kode_kelompok));

          $kode = $username->id_petani . date('ymd') . date('his') . $_POST['Data']['id_seaweed'] . rand(0, 9);
          //Helper::dd($username);
          if ($username) {
            $seaweed->attributes = $_POST['Data'];
            $seaweed->kode_produksi = $kode;
            $seaweed->id_user = $username->id_petani;
            $seaweed->id_seaweed = $_POST['Data']['id_seaweed'];
            $seaweed->id_gudang = $gudang->id_gudang;
            $seaweed->id_kelompok = $kelompok->id_kelompok;
            $seaweed->kadar_air = (float)$_POST['Data']['kadar_air'];
            $seaweed->total_panen = (float)$_POST['Data']['total_panen'];
            $seaweed->created_by = isset($username->username) ? $username->username : Yii::app()->user->getName();
            if ($seaweed->save()) {
              $pesan = 'Success';
              $keyid = isset($seaweed->id) ? $seaweed->id : null;
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
        $jsonData['panrita_insert'] = array(
          'message'       => $pesan,
          'error'         => $error,
          'keyid'         => (int)$keyid,
          'kode_produksi' => $kode,
        );
        echo CJSON::encode($jsonData);
      }
      //}else {
      //$this->redirect("/");
      //}
    }

    public function actionReadStatus()
    {
      $error = 0;
      $id = $this->userAuth['userid'];
      $model = Messages::model()->findByPk((int)$this->is_read);

      if (isset($status)) {
        $model->is_read = 1;
        if ($model->saveAttributes('is_read')) {
          $error = 0;
        } else {
          $error = 1;
        }
      }
      $jsonData = array('error' => $error);

      return CJSON::encode($jsonData);
    }

    public function actionSentMessage()
    {
      $messages = new Messages;
      $user = Users::model()->findByPk(3);
      $fields = array();
      $pesan = "";
      //if($this->_useragent === 'Mobile-Panrita') {
      if ($this->_dataMobile && $this->_dataMobile === 'panritaid') {
        if (isset($_POST['Messages'])) {
          $postMessages = $_POST['Messages'];
          $messages->attributes = $postMessages;
          $messages->userid = (int)$postMessages['from'];
          $messages->kode_gudang = 1;
          $messages->roomid = 1;
          $messages->kode_kelompok = 1;
          $messages->subject = 'Sent Message From Mobile';
          $messages->from = ucfirst(Petani::model()->getUserName($postMessages['from']));
          $messages->to = $user->username;
          $messages->to_userid = (int)$user->id;
          $messages->content = $postMessages['content'];
          $messages->date_send = date('Y-m-d H:i:s');
          $messages->date_receive = date('Y-m-d H:i:s');
          $messages->sent_status = isset($postMessages['sent']) ? $postMessages['sent'] : 0;
          $messages->is_read = isset($postMessages['read']) ? $postMessages['read'] : 0;
          $messages->is_draft = isset($postMessages['draft']) ? $postMessages['draft'] : 0;

          if ($messages->save()) {
            $pesan = "Pesan anda telah berhasil terkirim";
            $error = 0;
          } else {
            Helper::dd($messages->getErrors());
            $pesan = "Pesan anda gagal terkirim";
            $error = 1;
          }
          $jsonData['panrita_message_room'] = array('pesan' => $pesan, 'error' => $error);
          echo CJSON::encode($jsonData);
        }
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
        $sql = "SELECT * FROM messages WHERE roomid = 1 AND to_userid = 3 AND userid = " . $this->userAuth['userid'] . " OR to_userid =" . $this->userAuth['userid'] . " ORDER BY date_send DESC";

        $messages = Messages::model()->byDate()->findAllBySql($sql);

        $total = count($messages);
        $fields = array();

        foreach ($messages as $key => $message) {
          $fields[$key]['userid'] = (int)$message->userid;
          $fields[$key]['messageid'] = (int)$message->id;
          $fields[$key]['message'] = Helper::cleanString($message->content);
          if ((int)$message->userid !== (int)$this->userAuth['userid']) {
            $fields[$key]['display_name'] = 'Admin';
          } else {
            $fields[$key]['display_name'] = Petani::model()->getDisplayName($message->userid);
          }
          $fields[$key]['sent'] = ($message->sent_status = 1) ? true : false;
          $fields[$key]['read'] = $this->is_read;
          $fields[$key]['waktu'] = $message->date_send;
        }

        $jsonData['panrita_message_room'] = array('data' => $fields);
        echo CJSON::encode($jsonData);
      }
      //}else {
      //$this->redirect("/");
      //}

    }

  }