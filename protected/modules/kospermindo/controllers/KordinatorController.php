<?php

  class KordinatorController extends KController
  {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//    public function filters()
//    {
//      return array(
//        'rights',
//      );
//    }

    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }
      //$data=M_koordinator::showDatabyGudang($id_gudang);
      //Helper::dd($data,'data');
      $id = Yii::app()->user->getId();
      // $data = Pengguna::model()->findAll(
      //   array(
      //         'condition' => 'id_perusahaan = :id',
      //         'params'    => array(':id' => $id)
      //     )
      //   );
      // // // //$data=Company::model()->getPerusahaan($perusahaan->idperusahaan);
      // // // //Helper::dd($data);

      // // // // $dataProvider = new CActiveDataProvider('Users');
      // $this->render('index', array(
      //   'data' => $data,
      // ));
      $dataProvider = new CActiveDataProvider('TabelKoordinator');
      $this->render('index', array(
        'data' => $dataProvider,
      ));

      // }
      // $model = Kordinator::model()->findAll();
      // $this->render();

      //$dataProvider = new CActiveDataProvider('Gudang');
      //$gudang = M_gudang::getAllDataGudang();
      // $gudang = M_koordinator::showkoordinator();
      // //Helper::dd($gudang,'gudang');
      // $this->render('index', array('gudang' => $gudang));
    }

    public function actionTes($id_gudang)
    {
      if ($id_gudang) {
        if (Yii::app()->user->isGuest) {
          $this->redirect('/login');
        }
        //$data=M_koordinator::showDatabyGudang($id_gudang);
        //Helper::dd($data,'data');
        //$dataProvider = new CActiveDataProvider(M_koordinator::model()->showDatabyGudang(array('id_gudang'=>$id_gudang)));
        $dataProvider = new CActiveDataProvider('KoordinatorUpdate', array(
          'criteria' => array(
            'select'    => '*',
            'condition' => 'id_gudang= :id',
            'params'    => array(':id' => $id_gudang),
          ),
        ));

        $this->render('index', array(
          'data'      => $dataProvider,
          'id_gudang' => $id_gudang,
        ));
      }
    }

    public function actionView($id)
    {
      $this->render('view', array(
        'model' => $this->loadModel($id),
      ));
    }

    public function actionShowForm()
    {
      $this->render('formtambah');
    }

    //Simpan data
    public function actionCreate()
    {
      $update ='gagal';
      $levelid = 1;
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
            $kordinator->attributes = $_POST['TabelKoordinator'];  
            $findUsername = Pengguna::model()->findByAttributes(array('username'=>$_POST['Pengguna']['username']));
            if($findUsername==null){
              if($userPengguna->save() && $kordinator->save()){
                $this->redirect('/kordinator');
              }else{
                helper::dd($userPengguna);
              }  
            }else{
              //tampilakan dialog box if data have already exist
               $this->redirect('/kordinator');
            }
            
          }else{
            helper::dd($kordinator);
          }
        }
        //helper::dd($userPengguna);
        
      }
      $this->render('create',array(
        'model'=>$userPengguna,
        'model_koordinator' =>$kordinator,
        // 'model_kelompok' =>$kelompok,
        // 'model_petani'=>$petani,
        'pesan' =>$pesan,
        'level' =>$levelid,
        'update' =>$update
      ));
      // $this->render('create', array(
      //   'model_koordinator' => $model_koordinator,
      //   'model_pengguna'    => $model_pengguna,
      //   'pesan'             => $pesan,
      //   'idgudang'          => $idgudang,
      //   'idkoordinator'     => $idkoordinator
      // ));
    }

    public function actionLihatkelompok($id)
    {
      $this->redirect(array('kelompok/lihatkelompok', 'id_koordinator' => $id));
    }

    public function actionUpdate($id)
    {
      $update = 'berhasil';
      if ($id) {
        $model_koordinator = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
        $model = Pengguna::model()->findByAttributes(array('username'=> $id));
        //$model_pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
        $pesan = '';
        if ((isset($_POST['TabelKoordinator']))) {
          $model_koordinator->attributes = $_POST['TabelKoordinator'];
          $model_koordinator->id_user = $id;
          //$model_pengguna->id_user = $id;
          if (($model_koordinator->save())) {
            $pesan = 'Data berhasil disimpan';
            //$update ='berhasil';
            $this->redirect('/kordinator');
          } else {
            Helper::dd($model_koordinator);
            $pesan = 'Data Gagal disimpan';
            //$update = 'gagal';
          }
        }
        $this->render('update', array(
          'model_koordinator' => $model_koordinator,
          'model'=>$model,
          // 'model_pengguna'    => $model_pengguna,
          'pesan'             => $pesan,
          'update'=>$update
          // 'idgudang'          => $model_koordinator->id_gudang,
          // 'idkoordinator'     => $model_koordinator->id_koordinator
          //'author'=>$author,
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
      $idkoordinator = Pengguna::model()->findByAttributes(array('username' => $id));
      $koordinator = Pengguna::model()->findAllByAttributes(array('idkoordinator' => $idkoordinator['id']));
      $pesan = '';
      //helper::dd($koordinator);

      if (empty($koordinator)) {
        if ($req && $ajax) {
          if ($id) {
            $pengguna = Pengguna::model()->findByAttributes(array('username' => $id));
            $koordinatorku = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
            //Helper::dd($pengguna);
            $status = 0;
            $koordinatorku->status = $status;
            $pengguna->status = $status;
            $koordinatorku->id_user = $id;
            $pengguna->username = $id;

                    if (($koordinatorku->save()) && ($pengguna->save())) {
                      $pesan = 'success';
                      $redirectUrl = "/kordinator";
                    } else {
                      $pesan = 'failed';
                    }
                    
                  }
                    $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
                    echo CJSON::encode($data);
                }
          }else{
              if ($req && $ajax) {
                  if($id){
                    //Helper::dd($idkoordinator->id);
                    $status = 0;
                    $coba = Pengguna::model()->changeStatusKelompok($idkoordinator->id,$status);
                    // $apa = TabelKelompok::model()->getID($id);
                    // $c=" ";
                    //$sembarang = TabelKelompok::model()->getStatus(strtoupper($apa['id_kelompok']));
                    foreach ($koordinator as $ja) {
                        $cobalagi=Pengguna::model()->changeStatusKelompokPetani($ja['username'],$ja['levelid'],$status);
                    }
                    $pengguna = Pengguna::model()->findByAttributes(array('username' => $id));
                    $kordinatorku = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
                    $kordinatorku->status = $status;
                    $pengguna->status = $status;
                    $kordinatorku->id_user = $id;
                    $pengguna->username = $id;

                    if (($kordinatorku->save()) && ($pengguna->save())) {
                      $pesan = 'success';
                      $redirectUrl = "/kelompok";
                    } else {
                      $pesan = 'failed';
                    }
                    
                  }
                    $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
                    echo CJSON::encode($data);
                }
            }
        }
      
    // public function actionDelete($id)
    // {
    //     $carikordinator = TabelKoordinator::model()->find(array(
    //         'select'=>'id_koordinator',
    //         'condition'=>'id_user=:id_user',
    //         'params'=>array(':id_user'=>$id)));
    //     //Helper::dd($carikordinator->id_koordinator);
    //     $kelompok = TabelKelompok::model()->findAllByAttributes(array('id_koordinator'=>$carikordinator->id_koordinator));
    //     //Helper::dd($kelompok);
    //     $status = 0;
    //     if(empty($kelompok)){
    //       $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
    //       $koordinator = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
    //       // if (($pengguna->delete()) && ($koordinator->delete())) {
    //       //   Yii::app()->user->setFlash('success', "Form Posted!");
    //       //   $this->redirect('/kordinator');
    //       // } else {
    //       //   Yii::app()->user->setFlash('error', "Error text");
    //       // }
    //       if(empty($pengguna)&&(empty($koordinator))){
    //         //alert
    //         $this->redirect('/koordinator');
    //       }else{
    //         $pengguna->status = $status;
    //         $koordinator->status = $status;
    //         if (($koordinator->save()) && ($pengguna->save())) {
    //           $pesan = 'Data berhasil disimpan';
    //           $this->redirect('/kordinator');
    //           } else {
    //           Helper::dd($koordinator);
    //           $pesan = 'Data Gagal disimpan';
    //         }
    //       }
    //     }else{
    //       $apa = TabelKoordinator::model()->getID($id);
    //       //Helper::dd($apa);
    //       $sembarang = TabelKoordinator::model()->getStatus(strtoupper($apa['id_koordinator']));
    //       //Helper::dd($sembarang);
    //       foreach($sembarang as $ja) {
    //           $coba = TabelKoordinator::model()->updateKelompok($ja["id_user"],$status);
    //           $cobalagi = Pengguna::model()->updatePetani($ja["id_user"],$status);
    //           $cobacoba[]=TabelKelompok::model()->getStatus($ja["id_kelompok"]);
    //       }
    //       //Helper::dd($cobacoba);
    //       // $petani=(array)$idPetani;
    //       $result = array_reduce($cobacoba, 'array_merge', array());
    //       //Helper::dd($result['status']);
    //       for($i=0;$i<count($result);$i++){
    //           $cobalagilagi = Pengguna::model()->updatePetani($result[$i]['id_user'],$status);
    //           $cobalagilagi2 = TabelKelompok::model()->updatePetani($result[$i]['id_user'],$status);
    //       }

    //       $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
    //       $koordinator = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
    //       $pengguna->status = $status;
    //         $koordinator->status = $status;
    //         if (($koordinator->save()) && ($pengguna->save())) {
    //           $pesan = 'Data berhasil disimpan';
    //           $this->redirect('/kordinator');
    //           } else {
    //           Helper::dd($koordinator);
    //           $pesan = 'Data Gagal disimpan';
    //         }
    //     }
    // }
    public function actionaktifkanData($id)
    {
      $carikordinator = TabelKoordinator::model()->find(array(
        'select'    => 'id_koordinator',
        'condition' => 'id_user=:id_user',
        'params'    => array(':id_user' => $id),
      ));
      //Helper::dd($carikordinator->id_koordinator);
      $kelompok = TabelKelompok::model()->findAllByAttributes(array('id_koordinator' => $carikordinator->id_koordinator));
      //Helper::dd($kelompok);
      $status = 1;
      if (empty($kelompok)) {
        $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
        $koordinator = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
        // if (($pengguna->delete()) && ($koordinator->delete())) {
        //   Yii::app()->user->setFlash('success', "Form Posted!");
        //   $this->redirect('/kordinator');
        // } else {
        //   Yii::app()->user->setFlash('error', "Error text");
        // }
        if (empty($pengguna) && (empty($koordinator))) {
          //alert
          $this->redirect('/koordinator');
        } else {
          $pengguna->status = $status;
          $koordinator->status = $status;
          if (($koordinator->save()) && ($pengguna->save())) {
            $pesan = 'Data berhasil disimpan';
            $this->redirect('/kordinator');
          } else {
            Helper::dd($koordinator);
            $pesan = 'Data Gagal disimpan';
          }
        }
      } else {
        $apa = TabelKoordinator::model()->getID($id);
        //Helper::dd($apa);
        $sembarang = TabelKoordinator::model()->getStatus(strtoupper($apa['id_koordinator']));
        //Helper::dd($sembarang);
        foreach ($sembarang as $ja) {
          $coba = TabelKoordinator::model()->updateKelompok($ja["id_user"], $status);
          $cobalagi = Pengguna::model()->updatePetani($ja["id_user"], $status);
          $cobacoba[] = TabelKelompok::model()->getStatus($ja["id_kelompok"]);
        }
        //Helper::dd($cobacoba);
        // $petani=(array)$idPetani;
        $result = array_reduce($cobacoba, 'array_merge', array());
        //Helper::dd($result['status']);
        for ($i = 0; $i < count($result); $i++) {
          $cobalagilagi = Pengguna::model()->updatePetani($result[$i]['id_user'], $status);
          $cobalagilagi2 = TabelKelompok::model()->updatePetani($result[$i]['id_user'], $status);
        }

        $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
        $koordinator = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
        $pengguna->status = $status;
        $koordinator->status = $status;
        if (($koordinator->save()) && ($pengguna->save())) {
          $pesan = 'Data berhasil disimpan';
          $this->redirect('/kordinator');
        } else {
          Helper::dd($koordinator);
          $pesan = 'Data Gagal disimpan';
        }
      }
    }
    // foreach ($kelompok as $kelompok) {
    //   $userKelompok[]=$kelompok->id_user;
    //   $idPetani[]=TabelPetani::model()->findAllByAttributes(array('id_kelompok'=>$kelompok->id_kelompok));
    // }
    // for($i=0;$i<count($userKelompok);$i++){
    //     Pengguna::model()->deleteAll('id_user=:id_user',array(':id_user'=>$userKelompok[$i]));
    // }
    // $petani=(array)$idPetani;
    // $result = array_reduce($petani, 'array_merge', array());
    // //Helper::dd($result->id_user);
    // foreach ($result as $result) {
    //     $petaniUser[]=$result->id_user;
    // }
    // if(!empty($petaniUser)){
    //   for($i=0;$i<count($petaniUser);$i++){
    //     Pengguna::model()->deleteAll('id_user=:id_user',array(':id_user'=>$petaniUser[$i]));
    // }
    // }
    // $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
    // $koordinator = TabelKoordinator::model()->findByAttributes(array('id_user' => $id));
    // if (($pengguna->delete()) && ($koordinator->delete())) {
    //   Yii::app()->user->setFlash('success', "Form Posted!");
    //   $this->redirect('/kordinator');
    // } else {
    //   Yii::app()->user->setFlash('error', "Error text");
    // }
    public function actionlihatkontroller()
    {
      if (Yii::app()->request->isPostRequest) {
        if (Yii::app()->request->getPost('lihat')) {
          $apa = $_POST['cek'];
          $session = Yii::$app->session;
          $session->open();
          foreach ($session as $name => $value) {
            $session['id_koordinator'] = $apa;
            $session['coba'] = "hallo";
          }
          $tes = $session['id_koordinator'];
          //$koordinator = M_koordinator::showKoordinatorsebagian($apa);
          //$this->render('formedit',array('koordinator'=>$koordinator));
          var_dump($tes);
          // if($gudang = M_gudang::deleteDataGudang($apa)){
          //     $pesan = 'Data Berhasil di hapus';
          //     $this->redirect('index');
          // }else{
          //     $pesan = 'Data Gagal di update';
          // }
        }

      }
    }
    /**
     * Lists all models.
     */
    // public function actionIndex()
    // {
    // 	$dataProvider=new CActiveDataProvider('Kordinator');
    // 	$this->render('index',array(
    // 		'dataProvider'=>$dataProvider,
    // 	));
    // }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
      $model = new Kordinator('search');
      $model->unsetAttributes();  // clear any default values
      if (isset($_GET['Kordinator'])) {
        $model->attributes = $_GET['Kordinator'];
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
     * @return Kordinator the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
      $model = Kordinator::model()->findByPk($id);
      if ($model === null) {
        throw new CHttpException(404, 'The requested page does not exist.');
      }

      return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param Kordinator $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
      if (isset($_POST['ajax']) && $_POST['ajax'] === 'Kordinator-form') {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }
    }

    public function actionError()
    {
      if ($error = Yii::app()->errorHandler->error) {
        $this->render('error', $error);
      }
    }
  }
