<?php

class KomoditiController extends KController
{
  /**
   * Lists all models.
   */
  private function getKomoditi(){
    return new CActiveDataProvider('KomoditiType');
  }
  
  public function actionIndex()
  {
//    $id = Yii::app()->user->id;
//    if (Yii::app()->user->isGuest) {
//      $this->redirect('/login');
//    }
//
//    $dataProvider = new CActiveDataProvider('Komoditi');
//    $dataKomoditiTipe = $this->getKomoditi();
//    $this->render('index', array(
//      'data' => $dataProvider,
//      'datakomoditi' =>$dataKomoditiTipe,
//    ));
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
      $farmer = TabelPetani::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
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
      'farmerData' =>$farmerData
    ));
  }

  /**
   * Lists all models.
   */
  public function actionViewAllTipe()
  {
    $data = SubSeaweed::model()->getAllSubType();

    if (Yii::app()->user->isGuest) {
      $this->redirect('/login');
    }

    $dataProvider = new CActiveDataProvider('Komoditi');
//    $dataKomoditiTipe = new CActiveDataProvider('KomoditiType');
    $this->render('index', array(
      'data' => $dataProvider,
      'datakomoditi' =>$data,
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
      //status 1 = aktif
      //status 0 = tidak aktif
      $model_komoditi = new Komoditi;
      $model_komoditi_tipe = new KomoditiType;
      $modelSubType = new SubSeaweed;
      //$model_pengguna = new Pengguna;
      $idkomoditi = 'KOM-'.Helper::random_number(6);
      $pesan = '';
      if((isset($_POST['Komoditi']))){
          $model_komoditi->attributes=$_POST['Komoditi'];
          $model_komoditi->id_komoditi = $idkomoditi;

          if(($model_komoditi->save())) {
              $pesan = 'Data berhasil disimpan';
              $this->redirect('/commodity');
          }else{
              Helper::dd($model_komoditi);
              $pesan = 'Data Gagal disimpan';
          }
      }
      $this->render('create',array(
          'model_komoditi'=>$model_komoditi,
          'model_komoditi_tipe'=>$model_komoditi_tipe,
          'modelSubType'=>$modelSubType,
          'pesan' => $pesan,
          'idkomoditi'=>$idkomoditi
      ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreateTipe()
  {
    //status 1 = aktif
    //status 0 = tidak aktif
    //$model_komoditi = new Komoditi;
    $model_komoditi_tipe = new KomoditiType;
    //$model_pengguna = new Pengguna;
    $idkomoditi = 'KOM-'.Helper::random_number(6);
    $pesan = '';
    if((isset($_POST['Komoditi']))){
      $model_komoditi_tipe->attributes=$_POST['KomoditiTipe'];
      $model_komoditi_tipe->id_komoditi = $idkomoditi;

      if(($model_komoditi_tipe->save())) {
        $pesan = 'Data berhasil disimpan';
        $this->redirect('/commodity');
      }else{
        Helper::dd($model_komoditi_tipe);
        $pesan = 'Data Gagal disimpan';
      }
    }
    $this->render('createtipe',array(
      'model_komoditi_tipe'=>$model_komoditi_tipe,
      'pesan' => $pesan,
      'idtipe'=>$idkomoditi
    ));
  }



  public function actionBuat(){
     $model_komoditi = new KomoditiType;
      //$model_pengguna = new Pengguna;
      //$idkomoditi = 'KOM-'.Helper::random_number(6);
      $pesan = '';
      if((isset($_POST['KomoditiType']))){
          $model_komoditi->attributes=$_POST['KomoditiType'];
          //$model_komoditi->id_komoditi = $idkomoditi;
          //Helper::dd($_POST['TabelKomoditi']['status']);
          //Helper::dd($model_komoditi);
          if(($model_komoditi->save())) {
              $pesan = 'Data berhasil disimpan';
              $this->redirect('/commodity');
          }else{
              Helper::dd($model_komoditi);
              $pesan = 'Data Gagal disimpan';
          }
      }
      $this->render('buat',array(
          'model_komoditi'=>$model_komoditi,
          'pesan' => $pesan
      ));
  }

  public function actionDelete(){
    //Helper::dd($id);
    $data = array();
    $req = Yii::app()->request->getIsPostRequest();
    $ajax = Yii::app()->request->getIsAjaxRequest();
    $id = Yii::app()->request->getPost('id');
    $pesan = '';
    //echo $ajax;exit;
    if($req && $ajax){
      if($id){
        $status = 0;
        $komoditi = Komoditi::model()->findByAttributes(array('id_komoditi' => (int) $id));
        $komoditi->status = $status;

        if(($komoditi->save())) {
          $pesan = 'success';
          //$data['message'] = "success";
          $redirectUrl = "/commodity";
          //$this->redirect('/commodity');
        }else{
          //Helper::dd($commodity);
          $pesan = 'failed';
          //$data['message'] = "failed";
        }
      }
      $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
      echo CJSON::encode($data);
    }
  }

  public function actionUpdate($id){
    //Helper::dd($id);
    if($id){
      $pesan = "";
      $komoditi = Komoditi::model()->findByAttributes(array('id' => $id));
      $model_komoditi_tipe = new KomoditiType;
      if((isset($_POST['Komoditi']))){
          $komoditi->attributes=$_POST['Komoditi'];
          $komoditi->id_komoditi = $id;
          //Helper::dd($_POST['Komoditi']['status']);
          //Helper::dd($model_komoditi);
          if(($komoditi->save())) {
              $pesan = 'Data berhasil disimpan';
              $this->redirect('/commodity');
          }else{
              Helper::dd($komoditi);
              $pesan = 'Data Gagal disimpan';
          }
      }
    }
    $this->render('update',array(
      'model_komoditi'=>$komoditi,
      'pesan' => $pesan,
      'idkomoditi'=>$id,
      'model_komoditi_tipe'=>$model_komoditi_tipe,
    ));
  }

  public function actionAktifkanData(){
    $data = array();
    $req = Yii::app()->request->getIsPostRequest();
    $ajax = Yii::app()->request->getIsAjaxRequest();
    $id = Yii::app()->request->getPost('id');
    $pesan = '';
    //echo $ajax;exit;
    if($req && $ajax){
      if($id){
        $status = 1;
        $komoditi = Komoditi::model()->findByAttributes(array('id_komoditi' => (int) $id));
        $komoditi->status = $status;

        if(($komoditi->save())) {
          $pesan = 'success';
          //$data['message'] = "success";
          $redirectUrl = "/commodity";
          //$this->redirect('/commodity');
        }else{
          //Helper::dd($commodity);
          $pesan = 'failed';
          //$data['message'] = "failed";
        }
      }
      $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
      echo CJSON::encode($data);
    }
  }




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
	
}
*/