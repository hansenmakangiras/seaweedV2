<?php

  class WarehouseController extends KController
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
//    public function actionIndex()
//    {
//      //$pesan='';
//      if (Yii::app()->user->isGuest) {
//        $this->redirect('/kospermindo/login');
//      }
//
//      $dataProvider = new CActiveDataProvider('TabelKoordinator', array(
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
//      $allFarmers = TabelPetani::model()->countByAttributes(array('status'=>1));
//    $allGroups = TabelKelompok::model()->countByAttributes(array('status'=>1));
//    $allWarehouses = TabelKoordinator::model()->countByAttributes(array('status'=>1));
//    $summary = Komoditi::model()->getSumPanen();
//    $isCoordinator = TabelKoordinator::model()->findAllByAttributes(array('status'=>1));
//
//    $groups = TabelKelompok::model()->findAllByAttributes(array('status'=>1));
//    $cek = VKomoditibygroup::model()->findAll();
//    $romi = array();
//    foreach ($groups as $key => $valuee) {
//      foreach ($cek as $key => $value) {
//        if($value->idkelompok==$valuee->id_user){
//          array_push($romi, $value->total);
//        }else{
//          //array_push($romi, "0");
//          //array_push($romi, $value->total);
//        }
//      }
//    }
//    $apa = array();
//      $aku = array();
//      $kamu = array();
//      $allkelompok = Pengguna::model()->findAllByAttributes(array('levelid'=>2,'status'=>1));
//      foreach ($allkelompok as $value) {
//        $isPetani[]= Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
//        // $ispetani[] = Pengguna::model()->findAllByAttributes(array('idkelompok'=>$value->id));
//        $apa[] = Pengguna::model()->countByAttributes(array('idkelompok'=>$value->id));
//      }
//      $farmers = TabelPetani::model()->findAllByAttributes(array(
//      'id_perusahaan' => Yii::app()->user->id,
//        'status'        => 1,
//      ));
//      $cek = VKomoditibygroup::model()->findAll();
//    $isCoordinator = TabelKoordinator::model()->findAllByAttributes(array('status'=>1));
//    foreach ($isCoordinator as $key => $value) {
//      $isGroupAll[]=TabelKelompok::model()->countByAttributes(array('lokasi'=>$value->lokasi_gudang));
//    }
//
//    $tes = VKomoditibygroup::model()->getTotalPanen();
//    $totalpanengroup = array();
//    foreach ($isCoordinator as $key => $valuee) {
//      foreach ($tes as $key => $value) {
//        if($value['lokasi']==$valuee['lokasi_gudang']){
//          array_push($totalpanengroup, $value['total']);
//        }else{
//          //array_push($romi, "0");
//          //array_push($romi, $value->total);
//        }
//      }
//    }
//    $isfarmer = TabelPetani::model()->findAllByAttributes(array('status'=>1));
//    foreach ($isfarmer as $key => $value) {
//      $isfarmergroup[] = Pengguna::model()->getgroup($value->idkelompok);
//      $totalpanenpetani[] = Komoditi::model()->getPanenFarmer($value->id_user);
//    }
//      $this->render('index', array(
//        'data' => $dataProvider,
//        'total_panen'=>$totalpanengroup
//        //'pesan' =>$pesan
//      ));
//    }
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      $pesan = '';

      $lokasi = Yii::app()->request->getPost('lokasi');
      if(isset($lokasi)){
        $dataProvider = new TabelKoordinator;
        $gudang = TabelKoordinator::model()->findByAttributes(array('lokasi' => ucfirst($lokasi)));
        $gudang = !empty($gudang) ? $gudang : array();

        if(is_array($gudang) || is_object($gudang) && $gudang->lokasi !== ucfirst($lokasi)){
          $dataProvider->lokasi = ucfirst($lokasi);
          $dataProvider->deskripsi = '';
          $dataProvider->stok_masuk = 0;
          $dataProvider->stok_keluar = 0;
          $dataProvider->jumlah_stok = 0;
          $dataProvider->status = 1;
          if($dataProvider->save()){
            //$pesan = 'success';
            //$msg = 'Data berhasil disimpan';
            //$resp['redirect_url'] = "/kospermindo/warehouse";
            Yii::app()->user->setFlash('success','Data berhasil disimpan');
          }else{
            $msg = "Data gagal disimpan";
            //Helper::dd($dataProvider->errors);
            Yii::app()->user->setFlash('error','Data gagal disimpan');
          }

        }else{
          Yii::app()->user->setFlash('error', 'Data gudang : ' .$lokasi. ' sudah terdaftar');
          $pesan = "Data gudang : " .$lokasi. " sudah terdaftar";
        }
      }

      $dataProvider = new CActiveDataProvider('TabelKoordinator', array(
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

      $this->render('index', array(
        'data' => $dataProvider,
      ));
    }

    public function actionTambah(){
      $request = Yii::app()->request->getIsPostRequest();
      $dataProvider = new TabelKoordinator;
      $pesan = 'invalid';
      $resp = array();
      if($request){
        $lokasi = Yii::app()->request->getPost('lokasi');
        if(isset($lokasi)){
          $gudang = TabelKoordinator::model()->findByAttributes(array('lokasi' => ucfirst($lokasi)));
          $gudang = !empty($gudang) ? $gudang : array();
          if(is_array($gudang) || is_object($gudang) && $gudang->lokasi !== ucfirst($lokasi)){
            $dataProvider->lokasi = ucfirst($lokasi);
            $dataProvider->deskripsi = '';
            $dataProvider->stok_masuk = 0;
            $dataProvider->stok_keluar = 0;
            $dataProvider->jumlah_stok = 0;
            $dataProvider->status = 1;
            if($dataProvider->save()){
              $pesan = 'success';
              $msg = 'Data berhasil disimpan';
              $resp['redirect_url'] = "/kospermindo/warehouse";
              //Yii::app()->user->setFlash('success','Data berhasil disimpan');
            }else{
              $msg = "Data gagal disimpan";
              Helper::dd($dataProvider->errors);
              //Yii::app()->user->setFlash('error','Data gagal disimpan');
            }

          }else{
            $msg = "Data gudang : " .$lokasi. " sudah terdaftar";
          }

          $resp['login_status'] = $pesan;
          $resp['message'] = $msg;
          $resp['data'] = TabelKoordinator::model()->findAll();
        }

        echo CJSON::encode($resp);
      }

    }

    public function actionTambahAjax(){
      $request = Yii::app()->request->getIsPostRequest();
      $dataProvider = new TabelKoordinator;
      $pesan = 'invalid';
      $resp = array();
      if($request){
        $lokasi = Yii::app()->request->getPost('lokasi');
        if(isset($lokasi)){
          $gudang = TabelKoordinator::model()->findByAttributes(array('lokasi' => ucfirst($lokasi)));
          $gudang = !empty($gudang) ? $gudang : array();
          if(is_array($gudang) || is_object($gudang) && $gudang->lokasi !== ucfirst($lokasi)){
            $dataProvider->lokasi = ucfirst($lokasi);
            $dataProvider->deskripsi = '';
            $dataProvider->stok_masuk = 0;
            $dataProvider->stok_keluar = 0;
            $dataProvider->jumlah_stok = 0;
            $dataProvider->status = 1;
            if($dataProvider->save()){
              $pesan = 'success';
              $msg = 'Data berhasil disimpan';
              $resp['redirect_url'] = "/kospermindo/warehouse";
              //Yii::app()->user->setFlash('success','Data berhasil disimpan');
            }else{
              $msg = "Data gagal disimpan";
              Helper::dd($dataProvider->errors);
              //Yii::app()->user->setFlash('error','Data gagal disimpan');
            }

          }else{
            $msg = "Data gudang : " .$lokasi. " sudah terdaftar";
          }

          $resp['login_status'] = $pesan;
          $resp['message'] = $msg;
          $resp['data'] = TabelKoordinator::model()->findAll();
        }

        echo CJSON::encode($resp);
      }

    }

    public function actionUbah(){
      $request = Yii::app()->request->getIsPostRequest();
      $id = Yii::app()->request->getParam('id');
      $lokasi = Yii::app()->request->getParam('lokasi');

      $pesan = 'invalid';
      $resp = array();
      $gudang = array();
      if($request){
        if(isset($id)){
          //$gudang = Gudang::model()->findByPk($id);
          $gudang = Gudang::model()->findByPk($id);
          $gudang = !empty($gudang) ? $gudang : array();
          if(is_array($gudang) || is_object($gudang)){
            $gudang->lokasi = ucfirst($lokasi);
//            $gudang->deskripsi = '';
//            $gudang->stok_masuk = 0;
//            $gudang->stok_keluar = 0;
//            $gudang->jumlah_stok = 0;
//            $gudang->status= 1;
            if($gudang->saveAttributes('lokasi')){
//              $pesan = 'success';
//              $msg = 'Data berhasil disimpan';
//              $resp['redirect_url'] = "/kospermindo/warehouse";
              Yii::app()->user->setFlash('success','Data berhasil disimpan');
            }else{
//              $msg = "Data gagal disimpan";
//              Helper::dd($gudang->errors);
              Yii::app()->user->setFlash('error','Data gagal disimpan');
            }

          }else{
            //$msg = "Data gudang : " .$lokasi. " sudah terdaftar";
            Yii::app()->user->setFlash('error','Tidak ada data ditemukan');
          }

          //$resp['login_status'] = $pesan;
          //$resp['message'] = $msg;
        }

        //echo CJSON::encode($resp);
      }
      $this->render('ubah', array(
        'data'      => $gudang,
        //'id_gudang' => $id_gudang,
      ));

    }

    public function actionTes($id_gudang)
    {
      if ($id_gudang) {
        if (Yii::app()->user->isGuest) {
          $this->redirect('/login');
        }

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
      $idkoordinator = 'KOR' . Helper::random_number(6);
      $userPengguna = new Pengguna;
      $kordinator = new TabelKoordinator;
      $password = Helper::generateRandomString(10);
      $userPengguna->id_perusahaan = $id_perusahaan;
      $userPengguna->levelid = $levelid;
      $userPengguna->status = $status;
      $userPengguna->username = $idkoordinator;
      $userPengguna->password = $password;
      if($levelid=='1'){
        if(isset($_POST['lokasiGudang'])){
          $kordinator->id_perusahaan = $id_perusahaan;
          $kordinator->id_user = $idkoordinator;
          $kordinator->status = $status;
          $kordinator->lokasi_gudang = $_POST['lokasiGudang'];
          $findGudang = Petani::model()->findByAttributes(array('lokasi_gudang' => $_POST['lokasiGudang']));
          if($findGudang==null){
            if($userPengguna->save() && $kordinator->save()){
              $pesan="Data Berhasil Di Simpan";
              Yii::app()->user->setFlash('pesan',$pesan);
              $this->redirect('/kospermindo/warehouse',array('pesan'=>$pesan));
            }else{
              $pesan="Data Gagal Disimpan";
              Yii::app()->user->setFlash('pesan',$pesan);
              $this->redirect('/kospermindo/warehouse',array('pesan'=>$pesan));
            }
          }else{
            if($kordinator->lokasi_gudang == $findGudang->attributes['lokasi_gudang']) {
              $pesan = "Lokasi Gudang Sudah Terdaftar. Silahkan daftarkan gudang yang lain";
              Yii::app()->user->setFlash('pesan',$pesan);
              $this->redirect('/kospermindo/warehouse',array('pesan'=>$pesan));
            }
          }
        }
      }
      // $this->render('create',array(
      //   'model'=>$userPengguna,
      //   'model_koordinator' =>$kordinator,
      //   'pesan' =>$pesan,
      //   'level' =>$levelid,
      //   'update' =>$update
      // ));
    }
    public function actionLihatkelompok($id)
    {
      $this->redirect(array('kelompok/lihatkelompok', 'id_koordinator' => $id));
    }

    public function actionUpdate()
    {
      //Helper::dd($id);
      $id = Yii::app()->request->getParam('id');
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

//       $this->render('update', array(
//         'model' => $model,
//         'pesan' => $pesan,
//         'id'    => $id
//         //'author'=>$author,
//       ));
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
                  $redirectUrl = "/kospermindo/users/groups";
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
                  $redirectUrl = "/kospermindo/users/groups";
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
                  $redirectUrl = "/kospermindo/users/groups";
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
                  $redirectUrl = "/kospermindo/users/groups";
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
    //           $this->redirect('/warehouse');
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
          $this->redirect('/warehouse');
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
    //   $this->redirect('/warehouse');
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
