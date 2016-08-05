<?php

  class GudangController extends KController
  {
    private function addData($data)
    {
      if ($data || is_array($data)) {
        $dataProvider = new Gudang;
        $gudang = Gudang::model()->findByAttributes(array('lokasi' => ucfirst($lokasi)));
        $gudang = !empty($gudang) ? $gudang : array();

        if ($gudang && is_array($gudang) || is_object($gudang) && $gudang->lokasi !== ucfirst($lokasi)) {
          $dataProvider->lokasi = ucfirst($lokasi);
          $dataProvider->deskripsi = '';
          $dataProvider->stok_masuk = 0;
          $dataProvider->stok_keluar = 0;
          $dataProvider->jumlah_stok = 0;
          $dataProvider->status = 1;
          if ($dataProvider->save()) {
            Yii::app()->user->setFlash('success', 'Data berhasil disimpan');
          }
        }
      }
    }

    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      $pesan = '';

      if (isset($_POST['lokasi'])) {
        $lokasi = Yii::app()->request->getPost('lokasi');
        $lokasi = Helper::cleanString($lokasi);
        $dataProvider = new Gudang;
        $gudang = Gudang::model()->findByAttributes(array('lokasi' => ucfirst($lokasi)));
        $gudang = !empty($gudang) ? $gudang : array();

        if ($gudang !== null || is_array($gudang) || is_object($gudang) && $gudang->lokasi !== ucfirst($lokasi)) {
          $dataProvider->lokasi = ucfirst($lokasi);
          $dataProvider->deskripsi = '';
          $dataProvider->stok_masuk = 0;
          $dataProvider->stok_keluar = 0;
          $dataProvider->jumlah_stok = 0;
          $dataProvider->status = 1;
          if ($dataProvider->save()) {
            Yii::app()->user->setFlash('success', 'Data berhasil disimpan');
          }
        } else {
          Yii::app()->user->setFlash('error', 'Data gudang : ' . $lokasi . ' sudah terdaftar');
          $pesan = "Data gudang : " . $lokasi . " sudah terdaftar";
        }
      }

      $dataProvider = new CActiveDataProvider('Gudang', array(
        'criteria'      => array(
          'condition' => 'status=1',
          'order'     => 'id ASC',
        ),
        'countCriteria' => array(
          'condition' => 'status=1',
        ),
        'pagination'    => array(
          'pageSize' => 10,
          'pageVar'  => 'page',
          'route'    => $this->createUrl('/kospermindo/gudang'),
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

    public function actionShowForm()
    {
      $this->render('formtambah');
    }

    //Simpan data
    public function actionTambah()
    {
      $pesan = '';
      $model = new Gudang;
      $admin = Yii::app()->user->isAdmin;
      if ($admin) {
        if (isset($_POST['Gudang'])) {
//          Helper::dd($_POST['Gudang']);
          $findGudang = Gudang::model()->findByAttributes(array('nama' => ucfirst($_POST['Gudang']['nama'])));
          //Helper::dd($findGudang);
          if (empty($findGudang)) {
            if ($findGudang['nama'] !== ucfirst($_POST['Gudang']['nama'])) {
              $model->attributes = $_POST['Gudang'];
//              $model->nama = ucfirst($_POST['Gudang']['nama']);
//              $model->lokasi = ucfirst($_POST['Gudang']['lokasi']);
//              $model->penanggungjawab = ucfirst($_POST['Gudang']['penanggungjawab']);
//              $model->deskripsi = $_POST['Gudang']['deskripsi'];
//              $model->created_by = Yii::app()->user->getName();
//              $model->status = 1;
              if ($model->save()) {
                $pesan = "Gudang berhasil disimpan";
                Yii::app()->user->setFlash('error','Data gudang berhasil disimpan');
                $this->redirect("/kospermindo/warehouse");
              } else {
                Yii::app()->user->setFlash('error','Data gudang tidak gagal menyimpan ke database');
                //Helper::dd($model->errors);
              }
            } else {
              $pesan = "Gudang sudah terdaftar";
              Yii::app()->user->setFlash('error','Gudang sudah terdaftar');
            }
          }
        }
      } else {
        throw new CHttpException(403, 'You are not authorize to this');
      }
      $this->render('tambah', array(
        'model' => $model,
        'pesan' => $pesan,
      ));
    }

    public function actionTambahAjax()
    {
      $request = Yii::app()->request->getIsPostRequest();
      $dataProvider = new Gudang;
      $pesan = 'invalid';
      $resp = array();
      if ($request) {
        $lokasi = Yii::app()->request->getPost('lokasi');
        if (isset($lokasi)) {
          $gudang = Gudang::model()->findByAttributes(array('lokasi' => ucfirst($lokasi)));
          $gudang = !empty($gudang) ? $gudang : array();
          if (is_array($gudang) || is_object($gudang) && $gudang->lokasi !== ucfirst($lokasi)) {
            $dataProvider->lokasi = ucfirst($lokasi);
            $dataProvider->deskripsi = '';
            $dataProvider->stok_masuk = 0;
            $dataProvider->stok_keluar = 0;
            $dataProvider->jumlah_stok = 0;
            $dataProvider->status = 1;
            if ($dataProvider->save()) {
              $pesan = 'success';
              $msg = 'Data berhasil disimpan';
              $resp['redirect_url'] = "/kospermindo/warehouse";
              //Yii::app()->user->setFlash('success','Data berhasil disimpan');
            } else {
              $msg = "Data gagal disimpan";
              Helper::dd($dataProvider->errors);
              //Yii::app()->user->setFlash('error','Data gagal disimpan');
            }

          } else {
            $msg = "Data gudang : " . $lokasi . " sudah terdaftar";
          }

          $resp['login_status'] = $pesan;
          $resp['message'] = $msg;
          $resp['data'] = Gudang::model()->findAll();
        }

        echo CJSON::encode($resp);
      }
    }

    public function actionLihatkelompok($id)
    {
      $this->redirect(array('kelompok/lihatkelompok', 'id_koordinator' => $id));
    }

    public function actionUpdate()
    {
      $pesan = '';
      $admin = Yii::app()->user->isAdmin;
      $id = Yii::app()->request->getParam('id');
      $id = !empty($id) ? (int)$id : 0;
      $model = Gudang::model()->findByPk($id);
      if ($admin) {
        if (isset($_POST['Gudang'])) {
          $model->attributes = $_POST['Gudang'];
          $model->nama = ucfirst($_POST['Gudang']['nama']);
          $model->lokasi = ucfirst($_POST['Gudang']['lokasi']);
          $model->penanggungjawab = ucfirst($_POST['Gudang']['penanggungjawab']);
          $model->deskripsi = $_POST['Gudang']['deskripsi'];
          $model->created_by = Yii::app()->user->getName();
          $model->status = 1;
          if ($model->save()) {
            $pesan = "Gudang berhasil disimpan";
            $this->redirect("/kospermindo/warehouse");
          } else {
            Helper::dd($model->errors);
          }
        }

      } else {
        //Helper::dd($admin);
        throw new CHttpException(403, 'You are not authorize to this');
      }

      $this->render('update', array(
        'model' => $model,
        'pesan' => $pesan,
      ));
      //$update = 'berhasil';
//      if ($id) {
//        $model_koordinator = Gudang::model()->findByAttributes(array('id_user' => $id));
//        $model = Pengguna::model()->findByAttributes(array('username'=> $id));
//        //$model_pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
//        $pesan = '';
//        if ((isset($_POST['Gudang']))) {
//          $model_koordinator->attributes = $_POST['Gudang'];
//          $model_koordinator->id_user = $id;
//          //$model_pengguna->id_user = $id;
//          if (($model_koordinator->save())) {
//            $pesan = 'Data berhasil disimpan';
//            //$update ='berhasil';
//            $this->redirect('/kospermindo/seaweed');
//          } else {
//            Helper::dd($model_koordinator);
//            $pesan = 'Data Gagal disimpan';
//            //$update = 'gagal';
//          }
//        }
//        $this->render('update', array(
//          'model_koordinator' => $model_koordinator,
//          'model'=>$model,
//          // 'model_pengguna'    => $model_pengguna,
//          'pesan'             => $pesan,
//          'update'=>$update
//          // 'idgudang'          => $model_koordinator->id_gudang,
//          // 'idkoordinator'     => $model_koordinator->id_koordinator
//          //'author'=>$author,
//        ));
//      } else {
//        $this->redirect('site/error', true, 404);
//      }
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
      //$idgudang = Pengguna::model()->findByAttributes(array('username' => $id));
      //$koordinator = Pengguna::model()->findAllByAttributes(array('idkoordinator' => $idkoordinator['id']));
      $pesan = '';
      //helper::dd($koordinator);

      //if (empty($koordinator)) {
      if ($req && $ajax) {
        if ($id) {
          $warehouse = Gudang::model()->findByPk($id);
          //$koordinatorku = Gudang::model()->findByAttributes(array('id_user' => $id));
          //Helper::dd($pengguna);
          $status = 0;
          $warehouse->status = $status;
          //$pengguna->status = $status;
          //$koordinatorku->id_user = $id;
          //$pengguna->username = $id;

          if ($warehouse->saveAttributes(array('status'))) {
            $pesan = 'success';
            $redirectUrl = "/kospermindo/warehouse";
          } else {
            $pesan = 'failed';
          }

        }
        $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
        echo CJSON::encode($data);
      }
      //}
//      else{
//        if ($req && $ajax) {
//          if($id){
//            //Helper::dd($idkoordinator->id);
//            $status = 0;
//            $coba = Pengguna::model()->changeStatusKelompok($idkoordinator->id,$status);
//            // $apa = TabelKelompok::model()->getID($id);
//            // $c=" ";
//            //$sembarang = TabelKelompok::model()->getStatus(strtoupper($apa['id_kelompok']));
//            foreach ($koordinator as $ja) {
//              $cobalagi=Pengguna::model()->changeStatusKelompokPetani($ja['username'],$ja['levelid'],$status);
//            }
//            $pengguna = Pengguna::model()->findByAttributes(array('username' => $id));
//            $kordinatorku = Gudang::model()->findByAttributes(array('id_user' => $id));
//            $kordinatorku->status = $status;
//            $pengguna->status = $status;
//            $kordinatorku->id_user = $id;
//            $pengguna->username = $id;
//
//            if (($kordinatorku->save()) && ($pengguna->save())) {
//              $pesan = 'success';
//              $redirectUrl = "/kelompok";
//            } else {
//              $pesan = 'failed';
//            }
//
//          }
//          $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
//          echo CJSON::encode($data);
//        }
//      }
    }

    // public function actionDelete($id)
    // {
    //     $carikordinator = Gudang::model()->find(array(
    //         'select'=>'id_koordinator',
    //         'condition'=>'id_user=:id_user',
    //         'params'=>array(':id_user'=>$id)));
    //     //Helper::dd($carikordinator->id_koordinator);
    //     $kelompok = TabelKelompok::model()->findAllByAttributes(array('id_koordinator'=>$carikordinator->id_koordinator));
    //     //Helper::dd($kelompok);
    //     $status = 0;
    //     if(empty($kelompok)){
    //       $pengguna = Pengguna::model()->findByAttributes(array('id_user' => $id));
    //       $koordinator = Gudang::model()->findByAttributes(array('id_user' => $id));
    //       // if (($pengguna->delete()) && ($koordinator->delete())) {
    //       //   Yii::app()->user->setFlash('success', "Form Posted!");
    //       //   $this->redirect('/warehouse');
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
    //           $this->redirect('/warehouse');
    //           } else {
    //           Helper::dd($koordinator);
    //           $pesan = 'Data Gagal disimpan';
    //         }
    //       }
    //     }else{
    //       $apa = Gudang::model()->getID($id);
    //       //Helper::dd($apa);
    //       $sembarang = Gudang::model()->getStatus(strtoupper($apa['id_koordinator']));
    //       //Helper::dd($sembarang);
    //       foreach($sembarang as $ja) {
    //           $coba = Gudang::model()->updateKelompok($ja["id_user"],$status);
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
    //       $koordinator = Gudang::model()->findByAttributes(array('id_user' => $id));
    //       $pengguna->status = $status;
    //         $koordinator->status = $status;
    //         if (($koordinator->save()) && ($pengguna->save())) {
    //           $pesan = 'Data berhasil disimpan';
    //           $this->redirect('/warehouse');
    //           } else {
    //           Helper::dd($koordinator);
    //           $pesan = 'Data Gagal disimpan';
    //         }
    //     }
    // }
    public function actionaktifkanData($id)
    {
      $carikordinator = Gudang::model()->find(array(
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
        $koordinator = Gudang::model()->findByAttributes(array('id_user' => $id));
        // if (($pengguna->delete()) && ($koordinator->delete())) {
        //   Yii::app()->user->setFlash('success', "Form Posted!");
        //   $this->redirect('/warehouse');
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
            $this->redirect('/warehouse');
          } else {
            Helper::dd($koordinator);
            $pesan = 'Data Gagal disimpan';
          }
        }
      } else {
        $apa = Gudang::model()->getID($id);
        //Helper::dd($apa);
        $sembarang = Gudang::model()->getStatus(strtoupper($apa['id_koordinator']));
        //Helper::dd($sembarang);
        foreach ($sembarang as $ja) {
          $coba = Gudang::model()->updateKelompok($ja["id_user"], $status);
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
        $koordinator = Gudang::model()->findByAttributes(array('id_user' => $id));
        $pengguna->status = $status;
        $koordinator->status = $status;
        if (($koordinator->save()) && ($pengguna->save())) {
          $pesan = 'Data berhasil disimpan';
          $this->redirect('/warehouse');
        } else {
          Helper::dd($koordinator);
          $pesan = 'Data Gagal disimpan';
        }
      }
    }

    public function actionUbah($id)
    {
      $id = Yii::app()->request->getParam('id');
      if ($id) {
        //check in coordinator table
        $isGudang = Gudang::model()->findByAttributes(array('id' => $id));
        if (!empty($isGudang)) {
          $pesan = '';
          if ((isset($_POST['Gudang']))) {
            $isGudang->attributes = $_POST['Gudang'];
            $isGudang->id = $id;
            if ($isGudang->save()) {
              $pesan = 'Data berhasil disimpan';
              Yii::app()->user->setFlash('success', 'Data berhasil di perbaharui');
              $this->redirect('/kospermindo/gudang');
            } else {
              //Helper::dd($isGudang);
              Yii::app()->user->setFlash('success', 'Data gagal di perbaharui');
              $pesan = 'Data Gagal disimpan';
            }
          }
          $this->render('update', array(
            'model_koordinator' => $isGudang,
            'pesan'             => $pesan,
          ));
        }
      }
    }

    public function actionHapus()
    {
      $req = Yii::app()->request->getIsPostRequest();
      $ajax = Yii::app()->request->getIsAjaxRequest();
      $id = Yii::app()->request->getPost('id');
      //Helper::dd($id);
      $pesan = '';
      $redirectUrl = "/user";
      $status = 0;
      if ($req && $ajax) {
        if ($id) {
          $isGudang = Gudang::model()->findByAttributes(array('id' => $id));
          if (!empty($isGudang)) {
            $isGudang->status = $status;
            $isGudang->id = $id;
            if ($isGudang->save()) {
              $pesan = 'success';
              Yii::app()->user->setFlash('success', 'Data berhasil Dihapus');
              $redirectUrl = "/kospermindo/gudang";
            } else {
              Yii::app()->user->setFlash('error', 'Data Gagal disimpan');
              $pesan = 'invalid';
            }
            $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
            echo CJSON::encode($data);
          }

        }
      } else {
        echo CJSON::encode(array('message' => 'Your request is invalid'));
      }

    }

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
    //  $dataProvider=new CActiveDataProvider('Kordinator');
    //  $this->render('index',array(
    //    'dataProvider'=>$dataProvider,
    //  ));
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
