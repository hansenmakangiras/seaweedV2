<?php

  class GroupsController extends KController
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

      //$data=M_koordinator::showDatabyGudang($id_gudang);
      //Helper::dd($data,'data');
      $pesan='';
      $id_perusahaan = Yii::app()->user->getId();

      $koordinator = Pengguna::model()->findByAttributes(array('levelid'=>'1','status'=>1));
      if(empty($koordinator)){
        $pesan='gagal';
      }else{
        $pesan='berhasil';
      }
      $namaKelompok = Pengguna::model()->getNamaKelompok();
      $dataProvider = new CActiveDataProvider('TabelKelompok');
      $this->render('index', array(
        'data' => $dataProvider,
        'pesan' =>$pesan,
        'namaKelompok' => $namaKelompok
      ));
    }

    public function actionView($id)
    {
      $this->render('view', array(
        'model' => $this->loadModel($id),
      ));
    }

    public function actionLihatkelompok($id_koordinator)
    {
      $kelompok = M_kelompok::showKelompokByKor($id_koordinator);
      Helper::dd($kelompok);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionShowForm()
    {
      $this->render('formtambah');
    }

    public function actionCreate()
    {
      $pesan = '';
      $isGroups = new TabelKelompok;
      $isUser = new Pengguna;
      $isCordinatorUser = Pengguna::model()->findByAttributes(array('username'=>$_POST['lokasiKelompok']));
      $isCordinator = TabelKoordinator::model()->findByAttributes(array('id_user'=>$_POST['lokasiKelompok']));
      $levelid = 2;
      $id_perusahaan = Yii::app()->user->getId();
      $status = 1;
      $idkelompok = 'KEL'. Helper::random_number(6);
      $password = Helper::generateRandomString(10);
      if(isset($_POST['lokasiKelompok']) && isset($_POST['namaKelompok'])){
        $isGroups->nama_kelompok = $_POST['namaKelompok'];
        $isGroups->lokasi = $isCordinator->lokasi_gudang;
        $isGroups->id_user = $idkelompok;
        $isGroups->status = $status;
        $isGroups->id_perusahaan = $id_perusahaan;
        $isGroups->idgudang = $_POST['lokasiKelompok'];

        $isUser->levelid = $levelid;
        $isUser->id_perusahaan = $id_perusahaan;
        $isUser->username = $idkelompok;
        $isUser->password = $password;
        $isUser->idkoordinator = $isCordinatorUser->id;
        $isUser->status = $status;
        $groupsName = TabelKelompok::model()->findByAttributes(array('nama_kelompok'=>$_POST['namaKelompok']));
        if($groupsName==null){
          if($isGroups->save() && $isUser->save()){
            $pesan="Data Berhasil Di Simpan";
            Yii::app()->user->setFlash('pesan',$pesan);
            $this->redirect('/kospermindo/groups',array('pesan'=>$pesan));
          }else{
            $pesan = "Data Gagal Disimpan.";
            Yii::app()->user->setFlash('pesan',$pesan);
            $this->redirect('/kospermindo/groups',array('pesan'=>$pesan));
          }
        }else{
          $pesan = "Data Kelompok Sudah Ada. Silahkan isi data kelompok yang lain.";
          Yii::app()->user->setFlash('pesan',$pesan);
          $this->redirect('/kospermindo/groups',array('pesan'=>$pesan));
        }
        
      }else{

      }
    }

    public function actionEdit()
    {
      // $gudang = M_gudang::showGudangsebagian($id_gudang);
      // echo var_dump($gudang);
      if (Yii::app()->request->isPostRequest) {
        if (Yii::app()->request->getPost('edit')) {
          $apa = $_POST['cek'];
          $kelompok = M_kelompok::showkelompoksebagian($apa);
          $this->render('formedit', array('kelompok' => $kelompok));
          //var_dump($apa);
          // if($gudang = M_gudang::deleteDataGudang($apa)){
          //     $pesan = 'Data Berhasil di hapus';
          //     $this->redirect('index');
          // }else{
          //     $pesan = 'Data Gagal di update';
          // }
        }

      }
    }

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
              if ($isCoordinator->save()) {
                $pesan = 'Data berhasil disimpan';
                $this->redirect('/kospermindo/warehouse');
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
              //$changeCordinator = TabelKoordinator::model()->findByAttributes(array('lokasi_gudang'=>$_POST['Pengguna']['idkoordinator']));
              //$isGroup->idgudang = $changeCordinator->id_user;
              //$isGroup->lokasi  = $_POST['Pengguna']['idkoordinator'];  
              $isGroup->attributes = $_POST['TabelKelompok'];
              $isGroup->id_user = $id;
              //Helper::dd($_POST['Pengguna']['idkoordinator']);
              if (($isGroup->save())) {
                $pesan = 'Data berhasil disimpan';
                $this->redirect('/kospermindo/groups');
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
                $this->redirect('/kospermindo/users/petani');
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
                  $redirectUrl = "/kospermindo/users/petani";
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
                  $redirectUrl = "/kospermindo/users/petani";
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
                  $redirectUrl = "/kospermindo/groups";
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
                  $redirectUrl = "/kospermindo/groups";
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
                  $redirectUrl = "/kospermindo/groups";
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
                  $redirectUrl = "/kospermindo/groups";
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
                  $redirectUrl = "/kospermindo/warehouse";
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
                  $redirectUrl = "/kospermindo/warehouse";
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
                  $redirectUrl = "/kospermindo/warehouse";
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
                  $redirectUrl = "/kospermindo/warehouse";
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
      }else{
        echo CJSON::encode(array('message' => 'Your request is invalid'));
      }

    }

    public function actionaktifkanData($id)
    {
      $cariKelompok = TabelKelompok::model()->find(array(
        'select'    => 'id_kelompok',
        'condition' => 'id_user=:id_user',
        'params'    => array(':id_user' => $id),
      ));
      //mencari petani
      $petani = TabelPetani::model()->findAllByAttributes(array('id_kelompok' => $cariKelompok->id_kelompok));
      $status = 1;
      //Helper::dd($petani);
      // echo length($petani);
      if (empty($petani)) {
        $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
        $koordinator = TabelKelompok::model()->findByAttributes(array('id_user' => $id));
        if (empty($pengguna) && (empty($koordinator))) {

        } else {
          $koordinator->status = $status;
          $pengguna->status = $status;
          $koordinator->id_user = $id;
          $pengguna->id_user = $id;
          if (($koordinator->save()) && ($pengguna->save())) {
            $pesan = 'Data berhasil disimpan';
            $this->redirect('/groups');
          } else {
            Helper::dd($koordinator);
            $pesan = 'Data Gagal disimpan';
          }
        }
        // if(($pengguna->delete())&&($koordinator->delete())){
        //         // foreach ($petani as $petani) {
        //         //     $userPetani = Pengguna::model()->findByAttributes(array('id_user'=>$petani->id_user));
        //         //     $userPetani->delete();
        //         // }
        //         $this->redirect('/groups');
        //     }else{
        //         echo "gagal";
        //     }
      } else {
        $apa = TabelKelompok::model()->getID($id);
        $c = " ";
        //Helper::dd($apa);$id
        $sembarang = TabelKelompok::model()->getStatus(strtoupper($apa['id_kelompok']));
        foreach ($sembarang as $ja) {
          $coba = TabelKelompok::model()->updatePetani($ja["id_user"], $status);
          $cobalagi = Pengguna::model()->updatePetani($ja["id_user"], $status);
        }
        $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
        $koordinator = TabelKelompok::model()->findByAttributes(array('id_user' => $id));
        $koordinator->status = $status;
        $pengguna->status = $status;
        $koordinator->id_user = $id;
        $pengguna->id_user = $id;
        if (($koordinator->save()) && ($pengguna->save())) {
          $pesan = 'Data berhasil disimpan';
          $this->redirect('/groups');
        } else {
          Helper::dd($koordinator);
          $pesan = 'Data Gagal disimpan';
        }
      }
    }
    //Helper::dd($sembarang);
    // for($i=0;$i<count($sembarang);$i++){
    //     $sembarang[$i]['status']=$status;
    //     $petanistatus = $sembarang[$i];
    //     if($petani[$i]->save()){
    //         $c="berhasil";
    //     }else{
    //         $c="gagal";
    //     }
    // }
    //Helper::dd($sembarang);
    // foreach ($sembarang as $key => $value) {
    //     $tes = $value['status'];
    //     $tes = $status;
    //     Helper::dd($petani);

    //     $petani->status = $tes;
    //     if($petani->save()){
    //         $c = "berhasil";
    //     }else{
    //         $c = $m->error;
    //     }
    // }
    //Helper::dd($c);
    // // foreach ($petani as $petani) {
    // //     $petaniku[]=$petani->id_user;
    // // }
    // //Helper::dd($petaniku);
    // //print_r(count($petaniku));
    // foreach ($petaniku as $key => $value) {
    //     // Helper::dd($key);
    //     //Helper::dd($petaniku);
    //     $coba[$key] = TabelPetani::model()->findAllByAttributes(array('id_user'=>$value));
    // }
    // Helper::dd($coba);

    // for($i=0;$i<count($petaniku);$i++){
    //    //Pengguna::model()->deleteAll('id_user=:id_user',array(':id_user'=>$petaniku[$i]));
    //     $coba = TabelPetani::model()->findAllByAttributes(array('id_user'=>$petaniku[$i]));
    //     $petaniID[$i] =
    //     //$petaniID[$i]->attributes = '0';
    // }
    // Helper::dd($petaniID);
    // $userPetani = Pengguna::model()->findAllByAttributes(array('id_user'=>$petani->id_user));
    // Helper::dd($userPetani);
    // $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
    // $koordinator = TabelKelompok::model()->findByAttributes(array('id_user' => $id));
    // if(($query = Yii::app()->db->createCommand()->delete('tabel_petani','id_kelompok=:id_kelompok',array(':id_kelompok'=>$cariKelompok->id_kelompok)))){
    //     if(($pengguna->delete())&&($koordinator->delete())){
    //         // foreach ($petani as $petani) {
    //         //     $userPetani = Pengguna::model()->findByAttributes(array('id_user'=>$petani->id_user));
    //         //     $userPetani->delete();
    //         // }
    //         $this->redirect('/groups');
    //     }else{
    //         echo "gagal";
    //     }
    // }
    //lihat data petani berdasarkan id kelompok

    public function actionlihatpetani()
    {
      if (Yii::app()->request->isPostRequest) {
        if (Yii::app()->request->getPost('lihat')) {
          $apa = $_POST['cek'];
          //$kelompok = M_kelompok::showkelompoksebagian($apa);
          //$this->render('formedit',array('kelompok'=>$kelompok));
          var_dump($apa);
          // if($gudang = M_gudang::deleteDataGudang($apa)){
          //     $pesan = 'Data Berhasil di hapus';
          //     $this->redirect('index');
          // }else{
          //     $pesan = 'Data Gagal di update';
          // }
        }

      }
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
