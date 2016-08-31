<?php

  class UserController extends Controller
  {
//    public function filters(){
//      return array(
//        'rights'
//      );
//    }

//    public function allowedActions(){
//      '*';
//    }
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = '//layouts/column2';
    public function actionLevel()
    {
      $level = Level::model()->getListed();
      //$model = new Level;
      $dataProvider = new CActiveDataProvider('Level', array(
        'criteria'   => array(
          'order' => 'id ASC',
        ),
        'pagination' => array(
          'pageSize' => 10,
        ),
      ));
      $this->render('level', array(
        'dataProvider' => $dataProvider,
        'level'        => $level,
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
    public function actionManages()
    {
      $groupData = TabelKelompok::model()->findAllByAttributes(array(
        'id_perusahaan' => Yii::app()->user->id,
        'status'        => 1,
      ));
      $farmerData = Users::model()->findAllByAttributes(array(
        'isadmin'   => 0,
        'superuser' => 0,
        'status'    => 1,
        'levelid'   => 2,
        'groupid'   => 0,
        'companyid' => Yii::app()->user->id,
      ));
      $this->render('manages', array(
        'groupData'  => $groupData,
        'farmerData' => $farmerData,
      ));
    }

    public function actionCreate()
    {

    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
      //Helper::dd($id);
      if($id){
        //check in coordinator table
        $isCoordinator = TabelKoordinator::model()->findByAttributes(array('id_user'=>$id));
        $isGroup = TabelKelompok::model()->findByAttributes(array('id_user'=>$id));
        $isFarmer = TabelPetani::model()->findByAttributes(array('id_user'=>$id));
        if(!empty($isCoordinator)){
          $level = 1;
          $isUser = Pengguna::model()->findByAttributes(array('username'=> $id));
          if(!empty($isUser)){
            $pesan = '';
            if ((isset($_POST['TabelKoordinator']))) {
              $isCoordinator->attributes = $_POST['TabelKoordinator'];
              $isCoordinator->id_user = $id;
              //$model_pengguna->id_user = $id;
              if (($isCoordinator->save())) {
                $pesan = 'Data berhasil disimpan';
                $this->redirect('/user');
              } else {
                Helper::dd($isCoordinator);
                $pesan = 'Data Gagal disimpan';
              }
            }
            $this->render('update', array(
              'model_koordinator' => $isCoordinator,
              'model'=>$isUser,
              'pesan'=> $pesan,
              //'update'=>$update,
              'level'=>$level
            ));  
          }else{
            $this->redirect('site/error', true, 404);
          }
        }elseif (!empty($isGroup)) {
          $level = 2;
          $isUser = Pengguna::model()->findByAttributes(array('username'=> $id));
          if(!empty($isUser)){
            $pesan = '';
            if ((isset($_POST['TabelKelompok']))) {
              $isGroup->attributes = $_POST['TabelKelompok'];
              $isGroup->id_user = $id;
              //$model_pengguna->id_user = $id;
              if (($isGroup->save())) {
                $pesan = 'Data berhasil disimpan';
                $this->redirect('/user');
              } else {
                Helper::dd($isGroup);
                $pesan = 'Data Gagal disimpan';
              }
            }
            $this->render('update', array(
              'model_kelompok' => $isGroup,
              'model'=>$isUser,
              'pesan'=> $pesan,
              //'update'=>$update,
              'level'=>$level
            ));  
          }else{
            $this->redirect('site/error', true, 404);
          }
        }elseif (!empty($isFarmer)) {
          $level = 3;
          $isUser = Pengguna::model()->findByAttributes(array('username'=> $id));
          if(!empty($isUser)){
            $pesan = '';
            if ((isset($_POST['TabelPetani']))) {
              $isFarmer->attributes = $_POST['TabelPetani'];
              $isFarmer->id_user = $id;
              //$model_pengguna->id_user = $id;
              if (($isFarmer->save())) {
                $pesan = 'Data berhasil disimpan';
                $this->redirect('/user');
              } else {
                Helper::dd($isFarmer);
                $pesan = 'Data Gagal disimpan';
              }
            }
            $this->render('update', array(
              'model_petani' => $isFarmer,
              'model'=>$isUser,
              'pesan'=> $pesan,
              //'update'=>$update,
              'level'=>$level
            ));  
          }else{
            $this->redirect('site/error', true, 404);
          }
        }else{
          $this->redirect('site/error', true, 404);
        }
      }
      // $id = (int)$id;
      // if ($id) {
      //   //var_dump($id);exit;
      //   $model = Users::model()->findByPk(array('id' => $id));
      //   //var_dump($model);
      //   $pesan = '';
      //   if (isset($_POST['Users'])) {
      //     $model->attributes = $_POST['Users'];
      //     $model->id = $id;
      //     if ($model->save()) {
      //       $pesan = 'Data save successfully';
      //       //$this->redirect(array('view','id'=>$model->id_petani));
      //     } else {
      //       //Helper::dd($model);
      //       $pesan = 'Data failed to save';
      //     }
      //   }
      // }

      // $this->render('update', array(
      //   'model' => $model,
      //   'pesan' => $pesan,
      //   'id'    => $id
      //   //'author'=>$author,
      // ));
    }

    public function actionAddPetani(){
      $model = new Komoditi;
      $model_pengguna = new Pengguna;
      //$komoditi = Users::model()->getKomoditiTipe();
      $pesan = '';
      $userid = Yii::app()->user->getId();

      $this->render('add', array(
        'model' => $model,
        'model_pengguna' =>$model_pengguna,
        'pesan' => $pesan,
        //'model_level' => $model_level,
      ));
    }

    public function actionAddFarmers()
    {
      $farmerData = Users::model()->findAllByAttributes(array(
        'isadmin'   => 0,
        'superuser' => 0,
        'status'    => 1,
        'levelid'   => 2,
        'groupid'   => 0,
        'companyid' => Yii::app()->user->id,
      ));
      $this->render('addFarmers', array(
        'farmerData' => $farmerData,
      ));
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
      $redirectUrl = "/user";
      $status = 0;
      if ($req && $ajax) {
        if($id){
          $isFarmer = TabelPetani::model()->findByAttributes(array('id_user'=>$id));
          $isGroup = TabelKelompok::model()->findByAttributes(array('id_user'=>$id));
          $isCoordinator = TabelKoordinator::model()->findByAttributes(array('id_user'=>$id));
          if(!empty($isFarmer)){
            // Helper::dd($isFarmer);
            // exit();
            $isUser = Pengguna::model()->findByAttributes(array('username'=>$id));
            if(!empty($isUser)){
              if($isFarmer->status=="0" && $isUser->status=="0"){
                $status = 1;
                $isUser->status = $status;
                $isUser->username = $id;
                $isFarmer->status = $status;
                $isFarmer->id_user = $id;
                if($isUser->save() && $isFarmer->save()){
                  $pesan = 'success';
                  $redirectUrl = "/user";
                  //$this->redirect('/user/setfarmer');
                }else{
                  $pesan = 'failed';
                  //$this->redirect('site/error', true, 404);
                } 
              }else{
                $isUser->status = $status;
                $isUser->username = $id;
                $isFarmer->status = $status;
                $isFarmer->id_user = $id;
                if($isUser->save() && $isFarmer->save()){
                  $pesan = 'success';
                  $redirectUrl = "/user";
                  //$this->redirect('/user/setfarmer');
                }else{
                  $pesan = 'failed';
                  //$this->redirect('site/error', true, 404);
                }  
              }
              $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
              echo CJSON::encode($data);
            }else{
              $this->redirect('site/error', true, 404);
            }
          }elseif(!empty($isGroup)){
            //cari data petani di grup itu
            // Helper::dd($isGroup);
            // exit();
            $isUser = Pengguna::model()->findByAttributes(array('username'=>$id));
            $isFarmerAll = Pengguna::model()->findAllByAttributes(array('idkelompok' => $isUser->id));
            if (empty($isFarmerAll)) {
              if($isGroup->status=="0" && $isUser->status=="0"){
                $status=1;
                $isGroup->status = $status;
                $isUser->status = $status;
                $isGroup->id_user = $id;
                $isUser->username = $id;

                if (($isGroup->save()) && ($isUser->save())) {
                  $pesan = 'success';
                  $redirectUrl = "/user";
                } else {
                  $pesan = 'failed';
                }
              }else{
                $isGroup->status = $status;
                $isUser->status = $status;
                $isGroup->id_user = $id;
                $isUser->username = $id;

                if (($isGroup->save()) && ($isUser->save())) {
                  $pesan = 'success';
                  $redirectUrl = "/user";
                } else {
                  $pesan = 'failed';
                }
              } 
                $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
                echo CJSON::encode($data);
            }else{
              if($isGroup->status=="0" && $isUser->status=="0"){
                $status=1;
                foreach ($isFarmerAll as $ja) {
                  $coba = TabelKelompok::model()->changeStatusPetani($ja["username"], $status);
                  $cobalagi = Pengguna::model()->changeStatusPetani($ja["username"], $status);
                }
                //$pengguna = Pengguna::model()->findByAttributes(array('username' => $id));
                //$kelompok = TabelKelompok::model()->findByAttributes(array('id_user' => $id));
                $isGroup->status = $status;
                $isUser->status = $status;
                $isGroup->id_user = $id;
                $isUser->username = $id;
                if (($isGroup->save()) && ($isUser->save())) {
                  $pesan = 'success';
                  $redirectUrl = "/user";
                } else {
                  $pesan = 'failed';
                }
              }else{
                foreach ($isFarmerAll as $ja) {
                  $coba = TabelKelompok::model()->changeStatusPetani($ja["username"], $status);
                  $cobalagi = Pengguna::model()->changeStatusPetani($ja["username"], $status);
                }
                //$pengguna = Pengguna::model()->findByAttributes(array('username' => $id));
                //$kelompok = TabelKelompok::model()->findByAttributes(array('id_user' => $id));
                $isGroup->status = $status;
                $isUser->status = $status;
                $isGroup->id_user = $id;
                $isUser->username = $id;
                if (($isGroup->save()) && ($isUser->save())) {
                  $pesan = 'success';
                  $redirectUrl = "/user";
                } else {
                  $pesan = 'failed';
                }
              }
                $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
                echo CJSON::encode($data);
            }
          }elseif(!empty($isCoordinator)){
            //cari data group dan petani
            // Helper::dd($isCoordinator);
            // exit();
            $isUser = Pengguna::model()->findByAttributes(array('username'=>$id));
            $isGroupAll = Pengguna::model()->findAllByAttributes(array('idkoordinator'=>$isUser->id));
            if(empty($isGroupAll)){
              if($isCoordinator->status=="0" && $isUser->status=="0"){
                $status = 1;
                $isCoordinator->status = $status;
                $isCoordinator->id_user = $id;
                $isUser->status = $status;
                $isUser->username = $id;
                if($isCoordinator->save() && $isUser->save()){
                   $pesan = 'success';
                  $redirectUrl = "/user";
                } else {
                  $pesan = 'failed';
                }
              }else{
                $isCoordinator->status = $status;
                $isCoordinator->id_user = $id;
                $isUser->status = $status;
                $isUser->username = $id;
                if($isCoordinator->save() && $isUser->save()){
                   $pesan = 'success';
                  $redirectUrl = "/user";
                } else {
                  $pesan = 'failed';
                }
              }
              $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
              echo CJSON::encode($data);
            }else{
              //isi data jika data ada
              if($isCoordinator->status=="0" && $isUser->status=="0"){
                $status = 1;
                $coba = Pengguna::model()->changeStatusKelompok($isUser->id,$status);
                foreach ($isGroupAll as $ja) {
                  $cobalagi=Pengguna::model()->changeStatusKelompokPetani($ja['username'],$ja['levelid'],$status);
                }
                $isCoordinator->status = $status;
                $isCoordinator->id_user = $id;
                $isUser->status = $status;
                $isUser->username = $id;
                if($isCoordinator->save() && $isUser->save()){
                   $pesan = 'success';
                  $redirectUrl = "/user";
                } else {
                  $pesan = 'failed';
                }
              }else{
                $coba = Pengguna::model()->changeStatusKelompok($isUser->id,$status);
                foreach ($isGroupAll as $ja) {
                  $cobalagi=Pengguna::model()->changeStatusKelompokPetani($ja['username'],$ja['levelid'],$status);
                }
                $isCoordinator->status = $status;
                $isCoordinator->id_user = $id;
                $isUser->status = $status;
                $isUser->username = $id;
                if($isCoordinator->save() && $isUser->save()){
                   $pesan = 'success';
                  $redirectUrl = "/user";
                } else {
                  $pesan = 'failed';
                }
              }
              $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
              echo CJSON::encode($data);
            }
          }else{
            //data tidak ada memang
            $this->redirect('site/error', true, 404);
          }
        }else{
          //kirim redirect data bukan $id
        }
        
        // if ($id) {
        //   $status = 0;
        //   $pengguna = Pengguna::model()->findByAttributes(array('username' => $id));
        //   //Helper::dd($pengguna);
        //   $petani = TabelPetani::model()->findByAttributes(array('id_user' => $id));
        //   $kelompok = TabelKelompok::model()->findByAttributes(array('id_user'=>$id));
        //   $koordinator = TabelKoordinator::model()->findByAttributes(array('id_user'=>$id));
        //   $pengguna->status = $status;
        //   $pengguna->username = $id;
        //   if($petani==null){
        //     $pesan = 'failed';
        //     if($kelompok==null){
        //       $pesan = 'failed';
        //       if($koordinator==null){
        //         $pesan = 'failed';
        //       }else{
        //         $idkoordinator = Pengguna::model()->findByAttributes(array('username' => $id));
        //         $koordinatorAll = Pengguna::model()->findAllByAttributes(array('idkoordinator' => $idkoordinator['id']));
        //         if(empty($koordinatorAll)){
        //           $koordinator->status = $status;
        //           $koordinator->id_user = $id;
        //           $koordinator->save();  
        //         }else{
        //           $coba = Pengguna::model()->changeStatusKelompok($idkoordinator->id,$status);
        //           foreach ($koordinator as $ja) {
        //             $cobalagi=Pengguna::model()->changeStatusKelompokPetani($ja['username'],$ja['levelid'],$status);
        //           }
        //           //$pengguna = Pengguna::model()->findByAttributes(array('username' => $id));
        //           $kordinatorku = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
        //           $kordinatorku->status = $status;
        //           //$pengguna->status = $status;
        //           $kordinatorku->id_user = $id;
        //           $kordinatorku->save();
        //           //$pengguna->username = $id;
        //         }
        //       }
        //     }else{
        //       $cariKelompok=Pengguna::model()->find(array(
        //           'select'=>'id',
        //           'condition'=>'username=:id_user',
        //           'params'=>array(':id_user'=>$id),
        //           ));
        //       $petani = Pengguna::model()->findAllByAttributes(array('idkelompok'=>$cariKelompok->id));
        //       if(empty($petani)){
        //         $kelompok->status = $status;
        //         $kelompok->id_user = $id;
        //         $kelompok->save();  
        //       }else{
        //         foreach ($petani as $ja) {
        //                 $coba = TabelKelompok::model()->changeStatusPetani($ja["username"],$status);
        //                 $cobalagi = Pengguna::model()->changeStatusPetani($ja["username"],$status);
        //             }
        //         $kelompok = TabelKelompok::model()->findByAttributes(array('id_user' => $id));
        //         $kelompok->status = $status;
        //         $kelompok->id_user = $id;
        //         $kelompok->save();
        //       }
        //     }
        //   }else{
        //     $petani->status = $status;
        //     $petani->id_user = $id;
        //     $petani->save();
        //   }
        //   // //Helper::dd($pengguna);
        //   // $status = 0;
        //   // $petani->status = $status;
        //   // $pengguna->status = $status;
        //   // $petani->id_user = $id;
        //   // $pengguna->username = $id;
        //   if (($pengguna->save())) {
        //     $pesan = 'success';
        //     $redirectUrl = "/user";
        //   } else {
        //     $pesan = 'failed';
        //   }

        //   // if(($user->save())) {
        //   //   $pesan = 'success';
        //   //   $redirectUrl = "/user";
        //   // }else{
        //   //   $pesan = 'failed';
        //   // }
        // }
        // $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
        // echo CJSON::encode($data);
      }else{
        echo CJSON::encode(array('message' => 'Your request is invalid'));
      }

    }

    public function actionSetgroup(){
      $groupData = TabelKelompok::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
      $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));
      $this->render('groupManage',array(
        'groupData' => $groupData,
        'farmerData' =>$farmerData));
    }
    public function actionSetwarehouse(){
      $warehouseData = TabelKoordinator::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
      $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));
      $this->render('warehouseManage',array(
        'warehouseData' => $warehouseData,
        'farmerData' =>$farmerData));
    }
    public function actionSetfarmer(){
      $farmer = TabelPetani::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
      $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));
      $this->render('farmerManage',array(
        'farmer' => $farmer,
        'farmerData' =>$farmerData));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/login');
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

    public function actionDetailseaweed($id){
      if($id){
        if($id==1){
          $seaweed = "sango-sango laut";
        }elseif($id==2){
          $seaweed = "spinosom";
        }elseif($id==3){
          $seaweed = "euchema cotoni";
        }elseif($id==4){
          $seaweed = "gracillaria kw 3";
        }elseif($id==5){
          $seaweed = "gracillaria kw 4";
        }elseif($id==6){
          $seaweed = "gracillaria bs";
        }else{
          $seaweed = "";
        }
        $detail = Komoditi::model()->findAllByAttributes(array('nama_komoditi'=>$seaweed));
        $this->render('seaweeddetails', array(
          'detail'=>$detail,
          'seaweed' =>$seaweed
      ));
      }
    }
    public function actionShowFarmers($id)
    {
      $idkelompok = Pengguna::model()->findByAttributes(array('username' => $id));
      $farmers = Pengguna::model()->findAllByAttributes(array('idkelompok' => $idkelompok->id));
      foreach ($farmers as $farmers) {
        $petani[] = TabelPetani::model()->findByAttributes(array('id_user' => $farmers['username']));
      }
      if (!empty($petani)) {
        $this->render('showfarmers', array(
          'farmers'    => $petani,
          'idkelompok' => $idkelompok,
        ));
      } else {
        //tampiilkan modal jika data farmer tidak ada
        $this->redirect('/user');
      }
    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
      $model = new Users('search');
      $model->unsetAttributes();  // clear any default values
      if (isset($_GET['Users'])) {
        $model->attributes = $_GET['Users'];
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
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
      $model = Users::model()->findByPk($id);
      if ($model === null) {
        throw new CHttpException(404, 'The requested page does not exist.');
      }

      return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
      if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }
  }
