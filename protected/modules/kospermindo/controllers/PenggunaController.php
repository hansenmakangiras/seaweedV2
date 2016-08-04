<?php

  class PenggunaController extends KController
  {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = '//layouts/column2';
//    public function filters(){
//      return array(
//        'rights'
//      );
//    }
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      // $dataProvider = new CActiveDataProvider('Pengguna');
      // $this->render('index', array(
      //   'data' => $dataProvider,
      // ));
      $id=Yii::app()->user->getId();
      //helper::dd($id);
      // $perusahaan = ModelUser::model()->findByAttributes(array('username'=>$id));
      // Helper::dd($perusahaan);
      $data = Pengguna::model()->findAll(
        array(
              'condition' => 'id_perusahaan = :id',
              'params'    => array(':id' => $id)
          )
        );
      // // //$data=Company::model()->getPerusahaan($perusahaan->idperusahaan);
      // // //Helper::dd($data);

      // // // $dataProvider = new CActiveDataProvider('Users');
      $this->render('index', array(
        'data' => $data,
      ));
    }
    public function actionTambah(){
      $this->render('tambah');
    }

    public function actionCreate($level)
    {
      $levelid = $level;
      $pesan = '';
      $id_perusahaan = Yii::app()->user->getId();
      $status = 1;
      $idkoordinator = 'KOR-' . Helper::random_number(6);
      $idgudang = 'GUD-'. Helper::random_number(6);
      $idkelompok = 'KEL-'. Helper::random_number(6);
      $idpetani = 'PET-'. Helper::random_number(6);
      $userPengguna = new Pengguna;
      $kordinator = new TabelKoordinator;
      $kelompok = new TabelKelompok;
      $petani = new TabelPetani;
      //helper::dd($mUser);
       if(isset($_POST['Pengguna'])){
        $userPengguna->id_perusahaan = $id_perusahaan;
        $userPengguna->levelid = $levelid;
        $userPengguna->status = $status;
        $userPengguna->attributes = $_POST['Pengguna'];
        if($levelid=='1'){
          if(isset($_POST['TabelKoordinator'])){
            $kordinator->id_perusahaan = $id_perusahaan;
            $kordinator->id_user = $_POST['Pengguna']['username'];
            $kordinator->status = $status;
            //$kordinator->id_koordinator = $idkoordinator;
            //$kordinator->id_gudang = $idgudang;
            $kordinator->attributes = $_POST['TabelKoordinator'];  
            if($userPengguna->save() && $kordinator->save()){
              $this->redirect('/kordinator');
            }else{
              helper::dd($userPengguna);
            }
          }else{
            helper::dd($kordinator);
          }
        }elseif ($levelid=='2') {
          $koordinator = Pengguna::model()->findByAttributes(array('levelid'=>'1','status'=>'1'));
          if(!empty($koordinator)){
            if(isset($_POST['TabelKelompok'])){
              $kelompok->id_perusahaan = $id_perusahaan;
              $kelompok->id_user = $_POST['Pengguna']['username'];
              $kelompok->status = $status;
              //$kelompok->id_kelompok = $idkelompok;
              $kelompok->attributes = $_POST['TabelKelompok'];
              if($userPengguna->save() && $kelompok->save()){
                $this->redirect('/kelompok');
              }else{
                helper::dd($userPengguna);
              }  
            }else{
              helper::dd($kelompok);
            }
          }else{
            echo "gagal";
          }        
        }elseif ($levelid=='3') {
          if(isset($_POST['TabelPetani'])){
            $id_kelompok = $_POST['Pengguna']['idkelompok'];
            //helper::dd($id_kelompok);
            $id_koordinator = Pengguna::model()->findByAttributes(array('id'=>$id_kelompok));
            //helper::dd($id_koordinator);
            $petani->id_perusahaan = $id_perusahaan;
            $petani->id_user = $_POST['Pengguna']['username'];
            $petani->status = $status;
            //$petani->id_petani = $idpetani;
            $userPengguna->idkoordinator = $id_koordinator->idkoordinator;
            $petani->attributes = $_POST['TabelPetani'];
            $petani->save();  
            if($userPengguna->save() && $petani->save()){
              $this->redirect('/petani');
            }else{
              helper::dd($userPengguna);
            }
          }else{
            helper::dd($petani);
          }
        }
        //helper::dd($userPengguna);
        
      }
      $this->render('create',array(
        'model'=>$userPengguna,
        'model_koordinator' =>$kordinator,
        'model_kelompok' =>$kelompok,
        'model_petani'=>$petani,
        'pesan' =>$pesan,
        'level' =>$levelid
      ));
      
    }
    public function actionPengaturan(){

    }

    public function actionLihatgudang($id)
    {
      $this->redirect(array('kordinator/tes', 'id_gudang' => $id));
    }

    public function actionUpdate($id)
    {


    }

    public function actionDelete($id)
    {
      

    }

    public function actionAdmin()
    {
      $model = new Petani('search');
      $model->unsetAttributes();  // clear any default values
      if (isset($_GET['Petani'])) {
        $model->attributes = $_GET['Petani'];
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
