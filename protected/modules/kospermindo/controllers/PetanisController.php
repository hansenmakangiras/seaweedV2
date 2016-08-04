<?php

  class PetaniController extends KController
  {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    public function actionView($id)
    {
      $this->render('view', array(
        'model' => $this->loadModel($id),
      ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
      $update = 'gagal';
      $pesan = '';
      $userPengguna = new Pengguna;
      $petani = new TabelPetani;
      $id_perusahaan = Yii::app()->user->getId();
      $data = "";
      $level_user = 2;

      $kelompokCek = Pengguna::model()->findByAttributes(array('levelid' => '2', 'status' => 1));

      if (!empty($kelompokCek)) {
        $levelid = 3;
        $status = 1;

        //helper::dd($mUser);
        if (isset($_POST['Pengguna'])) {

          $userPengguna->attributes = $_POST['Pengguna'];
          $userPengguna->id_perusahaan = $id_perusahaan;
          $userPengguna->levelid = $levelid;
          $userPengguna->level_user= $level_user;
          $userPengguna->status = $status;

          if ($levelid == '3') {
            if (isset($_POST['TabelPetani'])) {
              $petani->attributes = $_POST['TabelPetani'];
              $petani->id_perusahaan = $id_perusahaan;
              $petani->id_user = $_POST['Pengguna']['username'];
              $petani->status = $status;

              $korUser = TabelKelompok::model()->findByAttributes(array('nama_kelompok' => $_POST['Pengguna']['idkelompok']));
              $koodinatorId = Pengguna::model()->findByAttributes(array('username' => $korUser->id_user));
              $petani->idkelompok = $korUser->id_user;
              $petani->idgudang = $korUser->idgudang;
              $IDKelompok = intval($koodinatorId->id);
              $IDKoordinator = intval($koodinatorId->idkoordinator);

              $userPengguna->idkelompok = $IDKelompok;
              $userPengguna->idkoordinator = $IDKoordinator;
              $petani->tanggal_lahir = date('Y-m-d', strtotime($_POST['TabelPetani']['tanggal_lahir']));
              //Helper::dd($_POST['TabelPetani']['tanggal_lahir']);
              //Helper::dd($petani->tanggal_lahir);

              $findUsername = Pengguna::model()->findByAttributes(array('username' => $_POST['Pengguna']['username']));
              if ($findUsername == null) {
                if ($userPengguna->save() && $petani->save()) {
                  $this->redirect('/kospermindo/petani');
                } else {
                  Helper::dd($userPengguna);
                }
              } else {
                $this->redirect('/petani');
              }
            } else {
              Helper::dd($petani);
            }
          }
        }
      } else {
        $pesan = 'gagal';
        $update = 'berhasil';
        $data = TabelPetani::model()->findAll(
          array(
            'condition' => 'id_perusahaan = :id',
            'params'    => array(':id' => $id_perusahaan),
          )
        );
      }

      $this->render('create', array(
        'model'        => $userPengguna,
        'model_petani' => $petani,
        'pesan'        => $pesan,
        'update'       => $update,
        'data'       => $data,
      ));

    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
      $update = 'berhasil';
      if ($id) {
        $model_petani = TabelPetani::model()->findByAttributes(array('id_user' => $id));
        $model = Pengguna::model()->findByAttributes(array('username' => $id));

        //$model_pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
        $pesan = '';
        if ((isset($_POST['TabelPetani']))) {
          $model_petani->attributes = $_POST['TabelPetani'];
          $model_petani->id_user = $id;
          //$model_pengguna->id_user = $id;
          if (($model_petani->save())) {
            $pesan = 'Data berhasil disimpan';
            $this->redirect('/petani');
          } else {
            Helper::dd($model_petani);
            $pesan = 'Data Gagal disimpan';
          }
        }
        $this->render('update', array(
          'model_petani' => $model_petani,
          'model'        => $model,
          'pesan'        => $pesan,
          'update'       => $update,
        ));
      } else {
        $this->redirect('site/error', true, 404);
      }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete()
    {
      $req = Yii::app()->request->getIsPostRequest();
      $ajax = Yii::app()->request->getIsAjaxRequest();
      $id = Yii::app()->request->getPost('id');
      //Helper::dd($id);
      $pesan = '';

      if ($req && $ajax) {
        if ($id) {
          // $pengguna = Pengguna::model()->checkStatusPengguna($id);
          // $petani = TabelPetani::model()->checkStatusPetani($id);
          $pengguna = Pengguna::model()->findByAttributes(array('username' => $id));
          $petani = TabelPetani::model()->findByAttributes(array('id_user' => $id));
          //Helper::dd($pengguna);
          $status = 0;
          $petani->status = $status;
          $pengguna->status = $status;
          $petani->id_user = $id;
          $pengguna->username = $id;

          if (($petani->save()) && ($pengguna->save())) {
            $pesan = 'success';
            $redirectUrl = "/petani";
          } else {
            $pesan = 'failed';
          }

        }
        $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
        echo CJSON::encode($data);
      }
    }

    public function actionDetails($id)
    {
      $petani = TabelPetani::model()->findByAttributes(array('id_user' => $id));
      $this->render('details', array(
        'model_petani' => $petani,
      ));
    }

    public function actionaktifkanData()
    {
      $req = Yii::app()->request->getIsPostRequest();
      $ajax = Yii::app()->request->getIsAjaxRequest();
      $id = Yii::app()->request->getPost('id');
      $pesan = '';

      if ($req && $ajax) {
        if ($id) {
          $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
          $petani = TabelPetani::model()->findByAttributes(array('id_user' => $id));
          $status = 1;
          if ((empty($pengguna)) && (empty($petani))) {
            //munculkan pesan data tidak ada dan redirect ke data petani
          } else {
            $petani->status = $status;
            $pengguna->status = $status;
            $petani->id_user = $id;
            $pengguna->id_user = $id;
            if (($petani->save()) && ($pengguna->save())) {
              $pesan = 'success';
              $redirectUrl = "/petani";
            } else {
              $pesan = 'failed';
            }
          }
          $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
          echo CJSON::encode($data);
        }
      }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/users/login');
      }

      $pesan = "";
//      $data = array();
//      $profile = array();
//      $pengguna = AdmPengguna::model()->findAll('levelid = 3');
//      foreach ($pengguna as $item) {
//        $profile[] = Profiles::model()->findByAttributes(array('userid' => $item->id));
//      }
//      Helper::dd($profile);
      $dataProvider = Petani::model()->with('profile','kelompok','seaweed','pengguna')->findAll('userid');
      //Helper::dd($dataProvider);
      $this->render('index', array(
        'data' => $dataProvider,
        'pesan' => $pesan
      ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/login');
      }

      $model = new Petani('search');
      $model->unsetAttributes();  // clear any default values
      if (isset($_GET['m_petani'])) {
        $model->attributes = $_GET['m_petani'];
      }

      $this->render('admin', array(
        'model' => $model,
      ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id the ID of the model to be loaded
     *
     * @return Petani the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
      $model = Petani::model()->findByPk($id);
      if ($model === null) {
        throw new CHttpException(404, 'The requested page does not exist.');
      }

      return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param Petani $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
      if (isset($_POST['ajax']) && $_POST['ajax'] === 'petani-form') {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }
  }
