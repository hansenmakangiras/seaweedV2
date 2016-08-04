<?php

  class PetaniController extends KController
  {
    public function actionView($id)
    {
      $this->render('view', array(
        'model' => $this->loadModel($id),
      ));
    }

    public function actionTambah(){
      $update ='no';
      $isPetani = new TabelPetani;
      $isUser = new Pengguna;
      $isGudang = new Gudang;
      $id_perusahaan = Yii::app()->user->getId();
      $pesan = '';
      $status = 1;
      if(isset($_POST['Pengguna']) && isset($_POST['TabelPetani']) && isset($_POST['Gudang'])){
        $isUser->attributes = $_POST['Pengguna'];
        $isUser->status = $status;
        $isUser->id_perusahaan = $id_perusahaan;

        if($isUser->save()){
          $idgudang = Gudang::model()->findByAttributes(array('lokasi'=>$_POST['Gudang']));
          $idkelompok = TabelKelompok::model()->findByAttributes(array('id'=>$_POST['idkelompok']));
          $jenisRumputLaut = implode(',', $_POST['jenisRumputLaut']);
          $isPetani->attributes = $_POST['TabelPetani'];
          $isPetani->jenis_komoditi = $jenisRumputLaut;
          $isPetani->status = $status;
          $isPetani->idgudang = $idgudang->id;
          $isPetani->idkelompok = $idkelompok->id;
          $pengguna = Pengguna::model()->findByAttributes(array('username'=>$_POST['Pengguna']['username']));
          $isPetani->id_user = $pengguna->id;
          $isPetani->tanggal_lahir = date('Y-m-d', strtotime($_POST['TabelPetani']['tanggal_lahir']));
          

          if(!empty($_POST['moderator'])){
            $moderator = $_POST['moderator'];
            $isUser->is_moderator = 1;
            $isUser->levelid = 1; //moderator
          }else{
            $moderator = null;
          }

          if(!empty($_POST['ketua'])){
            $ketua_kelompok = $_POST['ketua'];
            if(empty($idkelompok->ketua_kelompok)) {
              $idkelompok->ketua_kelompok = $_POST['TabelPetani']['nama_petani'];
              $idkelompok->id = $_POST['idkelompok'];
              $idkelompok->save();  
            }else{
              $pesan = "Ketua Kelompok Sudah Ada. Hilangkan Tanda Ceklist pada Ketua Kelompok";
            }
          }else{
            $ketua = null;
          }
          if($isPetani->save()){
            Yii::app()->user->setFlash('success','Data berhasil disimpan');
            $this->redirect('/kospermindo/petani');
          }
        }
        
      }
      $this->render('create', array(
        'model'        => $isUser,
        'model_petani' => $isPetani,
        'model_gudang' => $isGudang,
        'pesan'        => $pesan,
        'update'       => $update
        // 'update'       => $update,
        // 'data'       => $data,
      ));
    }
    
    public function ActionListkelompok()
    {
      $isGudang = Gudang::model()->findByAttributes(array('lokasi'=>$_POST['nilai']));
      $data=TabelKelompok::model()->findAll('idgudang=:parent_id AND status=:status',array(':parent_id'=>$isGudang->id,':status'=>1));
      
      $data=CHtml::listData($data,'id','nama_kelompok');
      foreach($data as $value=>$name)
      {
        echo CHtml::tag('option',
        array('value'=>$value,'name'=>'idkelompok'),CHtml::encode($name),true);
      }
    }

    public function actionUbah($id){
      $update = 'yes';
      $pesan = '';
      $id = Yii::app()->request->getParam('id');
      if($id){
        $isPetani = TabelPetani::model()->findByAttributes(array('id'=>$id));
        if(!empty($isPetani)){
          if(isset($_POST['TabelPetani'])){
            $jenisRumputLaut = implode(',', $_POST['jenisRumputLaut']);
            $isPetani->attributes = $_POST['TabelPetani'];
            $isPetani->jenis_komoditi = $jenisRumputLaut;
            $isPetani->id = $id;
            if ($isPetani->save()) {
              $pesan = 'Data berhasil disimpan';
              Yii::app()->user->setFlash('success','Data berhasil di perbaharui');
              $this->redirect('/kospermindo/petani');
            } else {
              //Helper::dd($isPetani);
              Yii::app()->user->setFlash('success','Data gagal di perbaharui');
              $pesan = 'Data Gagal disimpan';
            }
          }
          $this->render('update', array(
              'model_petani' => $isPetani,
              'pesan'=> $pesan,
              'update' =>$update
            ));  
        }
      }
    }
    public function actionHapus(){
      $req = Yii::app()->request->getIsPostRequest();
      $ajax = Yii::app()->request->getIsAjaxRequest();
      $id = Yii::app()->request->getPost('id');
      //Helper::dd($id);
      $pesan = '';
      $redirectUrl = "/user";
      $status = 0;
      if ($req && $ajax) {
        if($id){
          $isPetani = TabelPetani::model()->findByAttributes(array('id'=>$id));
          $isUser = Pengguna::model()->findByAttributes(array('id'=>$isPetani->id_user));
          if(!empty($isPetani)){
                $isPetani->status = $status;
                $isUser->status = $status;
                $isPetani->id = $id;
                $isUser->id = $isPetani->id_user;
                if($isPetani->save() && $isUser->save()){
                  $pesan = 'success';
                  Yii::app()->user->setFlash('success','Data berhasil Dihapus');
                  $redirectUrl = "/kospermindo/petani";
                }else{
                  Yii::app()->user->setFlash('error','Data Gagal disimpan');
                  $pesan = 'invalid';
                }
            $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
            echo CJSON::encode($data);
          }

          }
      }else{
        echo CJSON::encode(array('message' => 'Your request is invalid'));
      }
      
    }
    

    public function actionDetails($id)
    {
      $petani = TabelPetani::model()->findByAttributes(array('id_user' => $id));
      $this->render('details', array(
        'model_petani' => $petani,
      ));
    }

    

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }
      $pesan = '';
      $dataProvider = new CActiveDataProvider('TabelPetani', array(
        'criteria' => array(
          'condition' => 'status=1',
          'order' => 'id ASC'
        ),
        'countCriteria' => array(
          'condition' => 'status=1'
        ),
        'pagination' => array(
          'pageSize' => 10,
        )
      ));

      $namaGudang = Gudang::model()->findAllByAttributes(array('status'=>1));
      $namaKelompok = TabelKelompok::model()->findAllByAttributes(array('status'=>1));
      if(empty($namaKelompok)){
        $pesan = "gagal";
      }

      $this->render('index', array(
        'data' => $dataProvider,
        'namaGudang' => $namaGudang,
        'pesan' =>$pesan
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
