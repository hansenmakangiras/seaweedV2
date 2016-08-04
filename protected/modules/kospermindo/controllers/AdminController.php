<?php

class AdminController extends KController
{
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      $dataProvider = new CActiveDataProvider('AdmPengguna', array(
        'criteria'      => array(
          'condition' => 'status=1',
          'order'     => 'id ASC',
        ),
        'countCriteria' => array(
          'condition' => 'status=1',
        ),
        'pagination'    => array(
          'pageSize' => 10,
        ),
      ));
      $this->render('index', array(
        'data' => $dataProvider,
      ));
    }

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
    $pesan = '';
    $id = Yii::app()->request->getPost('id');
    $model = new AdmPengguna;
    $profile = new Profiles;
    $warehouse = new Warehouse;
    $kelompok = new KelompokTani;

    if(isset($_POST['AdmPengguna'])){
      $postPengguna = $_POST['AdmPengguna'];
      $model->attributes = $postPengguna;
      $model->companyid = 1;
      $model->seaweed_id = 1;
      $model->levelid = (int) $postPengguna['username'];
      $model->username = $postPengguna['username'];
      $model->password = $postPengguna['password'];
      $model->profileid = 1;
      $penggunaExist = AdmPengguna::model()->findByAttributes(array('username' => $model->username));

        if(isset($_POST['Profiles'])){
          //Helper::dd(AdmPengguna::model()->getIdUser());
          $postProfiles = $_POST['Profiles'];
          $profile->attributes = $postProfiles;
          $profile->userid = AdmPengguna::model()->getIdUser();
          $firstName = explode(" ",$postProfiles['nama_lengkap']);
          $profile->firstname = $firstName[0];
          $profile->lastname = $firstName[1];
          $profile->no_telp = $postProfiles['no_telp'];
          $profile->nmr_identitas = $postProfiles['nmr_identitas'];
          $profile->tempat_lahir = $postProfiles['tempat_lahir'];
          $profile->tanggal_lahir = $postProfiles['tanggal_lahir'];
          //$profile->tanggal_lahir = $postProfiles['tanggal_lahir'];
        if(!$penggunaExist){
          if($model->save()){
            if($profile->save()){
              $pesan = "Data Pengguna berhasil disimpan";
              $this->redirect('/kospermindo/admin');
            }else{
              Helper::dd($profile->errors);
            }
          }else{
            Helper::dd($model->errors);
          }
        }
      }
    }
    $this->render('create', array(
      'model'          => $model,
      'pesan'          => $pesan,
      'profile'          => $profile,
    ));
  }

  public function actionUpdate()
  {
    $pesan = "";
    $id = Yii::app()->request->getParam('id');
    if ($id) {
      $model = AdmPengguna::model()->findByPk((int)$id);
      if ((isset($_POST['AdmPengguna']))) {
        $kelompokTani = $_POST['AdmPengguna'];
        $model->attributes = $kelompokTani;
        if (($model->save())) {
          $pesan = 'Data berhasil disimpan';
          $this->redirect('/kospermindo/kelompok');
        } else {
          Helper::dd($model);
          $pesan = 'Data Gagal disimpan';
        }
      }
    }
    $this->render('update', array(
      'model' => $model,
      'pesan' => $pesan
    ));
  }

  public function actionDelete()
  {
    $req = Yii::app()->request->getIsPostRequest();
    $ajax = Yii::app()->request->getIsAjaxRequest();
    $id = Yii::app()->request->getPost('id');
    $isUserLogin = isset(Yii::app()->user->isMobileLogin) ? Yii::app()->user->isMobileLogin : false;

    $pesan = '';
    $status = 0;
    $redirectUrl = "/kospermindo/kelompok";
    if ($req && $ajax) {
      if ($id) {
        $petani = Petani::model()->findAllByAttributes(array('kelompokid' => $id));
        $kelompok = AdmPengguna::model()->findByPk($id);
        if(isset($petani) || !empty($petani)){
          if(isset($kelompok) || !empty($kelompok)){
            foreach ($petani as $item) {
              $item->status = $status;
              $item->saveAttributes['status'];
            }
            if($kelompok->save()){
              $pesan = "success";
            }else{
              $pesan = "failed";
            }
          }
        }
      }
    }
    $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
    echo CJSON::encode($data);
  }

  public function actionAdmin()
  {
    $model = new AdmPengguna('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['AdmPengguna'])) {
      $model->attributes = $_GET['AdmPengguna'];
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
   * @return AdmPengguna the loaded model
   * @throws CHttpException
   */
  public function loadModel($id)
  {
    $model = AdmPengguna::model()->findByPk($id);
    if ($model === null) {
      throw new CHttpException(404, 'The requested page does not exist.');
    }

    return $model;
  }
}