<?php

  class ModeratorController extends KController
  {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = '//layouts/column2';
//    public function filters()
//    {
//      return array(
//        'rights',
//      );
//    }

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
      $update='anu';
      $pesan_group='anu';
      $pesan = '';
      $status = 1;
      $id_perusahaan = Yii::app()->user->getId();
      $isUser = new Pengguna;
      $isFarmer = new TabelPetani;
      $isProfile = new Profiles;
      $levelid = 3;
      if(isset($_POST['Pengguna'])){
        $isUser->attributes = $_POST['Pengguna'];
        $isUser->status = $status;
        $isUser->levelid = 4;
        $isUser->id_perusahaan = $id_perusahaan;
        //$lUser = $_POST['levelUser'];
        $levelUser=1;
        // if($lUser=='user'){
        //   $levelUser = 2; //level user
        // }elseif($lUser=='moderator'){
        //   $levelUser = 1; //level moderator
        // }else{
        //   $levelUser = 0; // no level
        // }
        $isUser->level_user = $levelUser;
        //$isFarmer->id_user = $_POST['Pengguna']['username'];
        $findUsername = Pengguna::model()->findByAttributes(array('username'=>$_POST['Pengguna']['username']));
        //$findFarmer = TabelPetani::model()->findByAttributes(array('id_user'=>$_POST['Pengguna']['username']));
        if($findUsername==null){
          //save data
          if($isUser->save()){
            $pesan="Data Berhasil Di Simpan";
            Yii::app()->user->setFlash('pesan',$pesan);
            $this->redirect('/kospermindo/moderator',array('pesan'=>$pesan));
          }else{
            $pesan = "Data Gagal disimpan";
            helper::dd($isUser);
          }
        }else{
          $pesan = "Moderator sudah terdaftar. Silahkan daftarkan moderator yang lain";
        }
      }
      $this->render('create', array(
        'model'        => $isUser,
        'model_petani' => $isFarmer,
        'pesan'        => $pesan,
        'update'       => $update,
        'pesan_group'  => $pesan_group,
        'profile'      => $isProfile
        // 'update'       => $update,
        // 'data'       => $data,
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
        if($id){
        $isCoordinator = new TabelPetani;
        $update='anu';
        $pesan_group='anu';
        $pesan = '';
        $status = 1;
        $id_perusahaan = Yii::app()->user->getId();
        $isUser = new Pengguna;
        $isFarmer = new TabelPetani;
        $isProfile = new Profiles;
        $isUser = Pengguna::model()->findByAttributes(array('id'=>$id));
        if(!empty($isUser)){
          $pesan = '';
          if ((isset($_POST['Pengguna']))) {
            $isUser->attributes = $_POST['Pengguna'];
            $isUser->id = $id;
            //$model_pengguna->id_user = $id;
            if (($isUser->save())) {
              $pesan = 'Data berhasil disimpan';
              $this->redirect('/kospermindo/users/moderator');
            } else {
              Helper::dd($isCoordinator);
              $pesan = 'Data Gagal disimpan';
            }
          }
          $this->render('update', array(
            'model_petani' => $isCoordinator,
            'model'=>$isUser,
            'pesan'=> $pesan,
            'update'       => $update,
            'pesan_group'  => $pesan_group,
            'profile'      => $isProfile
            //'update'=>$update,
            //'level'=>$level
          ));  
        }else{
          //kirim message tidak ditemukan data
        }
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
        $this->redirect('/kospermindo/login');
      }

      // $dataProvider = new CActiveDataProvider('Users', array(
      //   'criteria' => array(
      //     'condition' => 'status=1',
      //     'order' => 'id ASC'
      //   ),
      //   'countCriteria' => array(
      //     'condition' => 'status=1'
      //   ),
      //   'pagination' => array(
      //     'pageSize' => 10,
      //   )
      // ));
      //$user = Helper::dd(Yii::app()->user->lastLogin);
      $kelompok = array();
      $findGroup = array();
      $users = Users::model()->isSuperUser();
      if ($users == false) {
        $data = Users::model()->findAllByAttributes(array(
          'isadmin'   => 0,
          'superuser' => 0,
          'status'    => 1,
          'levelid'   => 2,
          'companyid' => Yii::app()->user->id,
        ));
        $dataUser = Pengguna::model()->findAllByAttributes(array(
          'levelid'       => 3,
          'id_perusahaan' => Yii::app()->user->id,
        ));
        foreach ($dataUser as $dataKelompok) {
          $kelompok[]= $dataKelompok->idkelompok;
        }
        for($i=0;$i<count($kelompok);$i++) {
          $findUsername[] = Pengguna::model()->findByAttributes(array('id'=>$kelompok[$i]));
          $findGroup[] = TabelKelompok::model()->findByAttributes(array('id_user'=>$findUsername[$i]['username']));
        }
        $komoditi = Komoditi::model()->findAllByAttributes(array('status'=>1));
        //Helper::dd($komoditi);
        $apa[]=0;
        foreach ($komoditi as $value) {
          $apa[]+=$value->total_panen;
        }

        //for profile 2
        $groupData = TabelKelompok::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

        //for profile 3
        $warehouseData = TabelKoordinator::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

        //for profile 4
        //$farmer = TabelPetani::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
        $farmer = Pengguna::model()->findAllByAttributes(array('levelid'=>3));
        $moderator = Pengguna::model()->findAllByAttributes(array('levelid'=>4));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));
        //Helper::dd(array_sum($apa));
      } elseif ($users == true) {
        $data = Users::model()->findAllByAttributes(array('status' => 1));
      }
      $summary = Komoditi::model()->getSummarySeaweed();
      //Helper::dd($summary);

      //Helper::dd(Users::model()->getKomoditiTipe());
      $dataProvider = new Users('search');
      $dataProvider->unsetAttributes();
      if (isset($_GET['Users'])) {
        $dataProvider->attributes = $_GET['Users'];
      }
//      $dataProvider = new CActiveDataProvider('Users', array(
//        'criteria' => array(
//          'condition' => 'status=1',
//          'order' => 'id ASC'
//        ),
//        'countCriteria' => array(
//          'condition' => 'status=1'
//        ),
//        'pagination' => array(
//          'pageSize' => 10,
//        )
//      ));

      // $this->render('groupManage',array(
      //   'groupData' => $groupData,
      //   'farmerData' =>$farmerData));
      $this->render('index', array(
        'data'     => $data,
        'dataUser' => $dataUser,
        'dataGroup'=>$findGroup,
        'summary' =>$summary,
        'groupData' => $groupData,
        'warehouseData' => $warehouseData,
        'farmer' => $farmer,
        'farmerData' =>$farmerData,
        'moderator' =>$moderator
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
