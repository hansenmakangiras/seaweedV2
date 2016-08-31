<?php

  class UsersController extends KController
  {
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }
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
          $findGroup[] = Kelompok::model()->findByAttributes(array('ketua_kelompok'=>$findUsername[$i]['username']));
        }
        $komoditi = Komoditi::model()->findAllByAttributes(array('status'=>1));
        //Helper::dd($komoditi);
        $apa[]=0;
        foreach ($komoditi as $value) {
          $apa[]+=$value->total_panen;
        }

        //for profile 2
        $groupData = Kelompok::model()->findAllByAttributes(array('ketua_kelompok'=>Yii::app()->user->id));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

        //for profile 3
        $warehouseData = Gudang::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
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

    public function actionRegister()
    {
      //$this->layout = '//layouts/singlepage';
      # Response data array
      $resp = array();
      $login_status = 'invalid';
      $pesan = '';

      $model = new RegisterForm;

      $token = !empty($_POST['token']) ? $_POST['token'] : '';

      // Make sure the request is POST.
      $request = Yii::app()->request->getIsPostRequest();
      $ajaxRequest = Yii::app()->request->getIsAjaxRequest();
      if ($request) {
        Helper::dd($_POST);
      }

      $this->render('register', array(
        'model' => $model,
        'pesan' => $pesan,
      ));
    }

    /**
     * Logs out the current user and redirect to login page.
     */
    public function actionLogout()
    {
      Yii::app()->user->logout(false);
      //$this->redirect('/kospermindo/users/login');
      $this->redirect('/');
      //$this->redirect(Yii::app()->homeUrl);
    }

    public function actionTambahkomoditi(){
      $levelid = 1;
      $pesan = '';
      $id_perusahaan = Yii::app()->user->getId();
      $status = 1;
      $nama_komoditi = "";
      $jenis_komoditi = 0;
      $komoditi = new Komoditi;
      $gudang = new Gudang;
      $kelompok = new Kelompok;
      $petani = new TabelPetani;
      if(isset($_POST['Gudang'])){
        if(isset($_POST['Kelompok'])){
          if(isset($_POST['TabelPetani'])){
            if(isset($_POST['Komoditi'])){
              //helper::dd($_POST['TabelPetani']['jenis_komoditi']);
              $komoditi->attributes = $_POST['Komoditi']; 
              $nama_komoditi = $_POST['TabelPetani']['jenis_komoditi'];
              $komoditi->nama_komoditi = $nama_komoditi;
              if($nama_komoditi=='Gracilaria KW3'){
                $jenis_komoditi = 1;
              }elseif ($nama_komoditi=='Gracilaria KW4') {
                $jenis_komoditi = 2;
              }elseif ($nama_komoditi=='Gracilaria BS') {
                $jenis_komoditi = 3;
              }elseif ($nama_komoditi=='Sango-Sango Laut') {
                $jenis_komoditi = 4;
              }elseif ($nama_komoditi=='Euchema Cotoni') {
                $jenis_komoditi = 5;
              }elseif ($nama_komoditi=='Spinosom') {
                $jenis_komoditi = 6;
              }
              $komoditi->jenis_komoditi = $jenis_komoditi;
              $komoditi->status = $status;
              $komoditi->id_user = $_POST['TabelPetani']['nama_petani'];
              if($komoditi->save()){
                $pesan="Data Berhasil Di Simpan";
                Yii::app()->user->setFlash('success','Data berhasil disimpan');
                $this->redirect('/kospermindo/users/panen',array('pesan'=>$pesan));
              }else{
                $pesan = "Data Gagal Disimpan";
                Yii::app()->user->setFlash('error','Data gagal disimpan');
              }
            }
          }
        }
      }

      $this->render('tambah',array(
        'komoditi' => $komoditi,
        'gudang'   => $gudang,
        'kelompok' => $kelompok,
        'petani'   => $petani,
        'pesan'    => $pesan,
      ));
    }

    public function actionListgudang(){
      $idGudang = $_POST['Gudang']['lokasi'];
      $isGudang = Gudang::model()->findByAttributes(array('lokasi'=>$idGudang));
      $allKelompok = Kelompok::model()->findAll('id_gudang = :idGudang', array(':idGudang'=>$isGudang->id));
      $allKelompok = CHtml::listData($allKelompok,'id','nama_kelompok');
      echo CHtml::tag('option',array('value'=>''),'-- Pilih Nama Kelompok --', true);
      foreach($allKelompok as $value=>$nama){
       echo CHtml::tag('option',array('value'=>$value),CHtml::encode($nama), true);
      }
    }
    public function actionListKelompok(){
      $idkelompok = $_POST['Kelompok']['nama_kelompok'];
      $isKelompok = Kelompok::model()->findByAttributes(array('nama_kelompok'=>$idkelompok));
      $allPetani = TabelPetani::model()->findAll('idkelompok = :id_kelompok', array(':id_kelompok'=>$idkelompok));
      $allPetani = CHtml::listData($allPetani,'id','nama_petani');
      echo CHtml::tag('option',array('value'=>''),'-- Pilih Nama Petani --', true);
      foreach($allPetani as $value=>$nama){
        echo CHtml::tag('option',array('value'=>$value),CHtml::encode($nama), true);
      }
    }
    public function actionListkomoditi(){
      $idPetani = $_POST['TabelPetani']['nama_petani'];
      $allKomoditi = TabelPetani::model()->findByAttributes(array('id'=>$idPetani));
      $jenisKomoditi = explode(",", $allKomoditi->jenis_komoditi);
      $komoditi = array();
      for($i=0;$i<count($jenisKomoditi);$i++){
        if($jenisKomoditi[$i]=='1'){
          $komoditi[$i] = "Gracillaria KW 3";
        }
        if($jenisKomoditi[$i]=='2'){
          $komoditi[$i] = "Gracillaria KW 4";
        }
        if($jenisKomoditi[$i]=='3'){
          $komoditi[$i] = "Gracillaria BS";
        }
        if($jenisKomoditi[$i]=='4'){
          $komoditi[$i] = "Sango-Sango Laut";
        }
        if($jenisKomoditi[$i]=='5'){
          $komoditi[$i] = "Euchema Cotoni";
        }
        if($jenisKomoditi[$i]=='6'){
          $komoditi[$i] = "Spinosom";
        }
      }
      // foreach ($komoditi as $value) {
      //   echo $value;
      //   echo "<br/>";
      // }
      $allKomoditi = CHtml::listData($allKomoditi,'id','jenis_komoditi');
      echo CHtml::tag('option',array('value'=>''),'-- Pilih Jenis Komoditi --', true);
      foreach($komoditi as $value=>$nama){
        echo CHtml::tag('option',array('value'=>$nama,'name'=>'jenis_komoditi'),CHtml::encode($nama), true);
      }
    }
    public function actionListpetani()
    {
      $isGudang = TabelPetani::model()->findByAttributes(array('nama_petani'=>$_POST['nilai']));
      $data = TabelPetani::model()->findByAttributes(array('jenis_komoditi'=>$isGudang->jenis_komoditi,'status'=>1));
      $jenisKomoditi = explode(",", $data->jenis_komoditi);
      $komoditi = array();
      for($i=0;$i<count($jenisKomoditi);$i++){
        if($jenisKomoditi[$i]=='1'){
          $komoditi[$i] = "Gracillaria KW 3";
        }
        if($jenisKomoditi[$i]=='2'){
          $komoditi[$i] = "Gracillaria KW 4";
        }
        if($jenisKomoditi[$i]=='3'){
          $komoditi[$i] = "Gracillaria BS";
        }
        if($jenisKomoditi[$i]=='4'){
          $komoditi[$i] = "Sango-Sango Laut";
        }
        if($jenisKomoditi[$i]=='5'){
          $komoditi[$i] = "Euchema Cotoni";
        }
        if($jenisKomoditi[$i]=='6'){
          $komoditi[$i] = "Spinosom";
        }
      }
      // helper::dd($komoditi);
      
      $data=CHtml::listData($data,'id','jenis_komoditi');
      
      foreach($komoditi as $value=>$name)
      {
        echo CHtml::tag('option',
        array('value'=>$value,'name'=>'idkelompok'),CHtml::encode($name),true);
      }
    }
    public function actionCreate(){
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
            $pesan = "Successed to save data";
            $this->redirect('/kospermindo/users');
          }else{
            $pesan = "Missed to save data";
            Helper::dd($isUser);
          }
        }else{
          $pesan = "Username is already exist";
          $this->redirect('/kospermindo/users');
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
    public function actionUpdate($id)
    {
      $pesan = "";
      $isGroups = Kelompok::model()->findByAttributes(array('id'=>$id));
      $isKomoditi = Komoditi::model()->findByAttributes(array('id'=>$id));
      if(!empty($isGroups)){
        $groupId = 2;
        $pesan = "";
        if($id){
          if(!empty($isGroups)){
            if(isset($_POST['Kelompok'])){
              $isFarmer=TabelPetani::model()->findByAttributes(array('id'=>$_POST['Kelompok']['ketua_kelompok']));
              $isGroups->ketua_kelompok = $isFarmer->nama_petani;
              $isGroups->id = $id;
              if($isGroups->save()){
                $pesan="Ketua Kelompok berhasil Di tambahkan";
                Yii::app()->user->setFlash('success','Data berhasil di perbaharui');
                $this->redirect('/kospermindo/users/groups',array('pesan'=>$pesan));
              }else{
                $pesan="Ketua Kelompok gagal Di tambahkan";
                Yii::app()->user->setFlash('success','Data gagal di perbaharui');
                $this->redirect('/kospermindo/users/groups',array('pesan'=>$pesan));
              }
            }
          }else{
            $pesan = "Data Tidak Ada";
          }
        }
        $this->render('update',array(
          'model_kelompok' => $isGroups,
          'pesan' => $pesan,
          'alert' => $groupId
          ));  
      }elseif (!empty($isKomoditi)) {
        $alert = 4;
        $pesan = "";
        if(isset($_POST['Komoditi'])){
          $isKomoditi->attributes = $_POST['Komoditi'];
          $isKomoditi->id = $id;
          if($isKomoditi->save()){
            $pesan="Data komoditi Berhasil Diperbaharui";
            Yii::app()->user->setFlash('success','Data berhasil diperbaharui');
            $this->redirect('/kospermindo/users/panen',array('pesan'=>$pesan));
          }else{
            $pesan="Data komoditi gagal diperbaharui";
            Yii::app()->user->setFlash('error','Data gagal diperbaharui');
            $this->redirect('/kospermindo/users/panen',array('pesan'=>$pesan));
          }
        }
        $this->render('update',array(
          'komoditi' => $isKomoditi,
          'pesan' => $pesan,
          'alert' => $alert
          ));  
      }
      
    }
    
    public function actionCreateelastic(){
    	$user = new Users;
    	$user->groupid = 1;
    	$user->companyid = 3;
    	$user->komoditi = 20;
    	$user->username = 'oche';
    	$user->password = 'oche';
    	$user->email = 'andri@dwiutomo';
    	$user->no_handphone = '09876';
    	$user->last_login = date('d-m-Y H:i:s');

    	if($user->save()){
    		var_dump("success");
    	}else{
    		var_dump("failed");
    	}

    }

    public function actionUpdatemoderator($id){
      $level = 1;
      $this->render('update',array('alert'=>$level));
    }

    public function actionDelete(){
      $req = Yii::app()->request->getIsPostRequest();
      $ajax = Yii::app()->request->getIsAjaxRequest();
      $id = Yii::app()->request->getPost('id');
      //Helper::dd($id);
      $pesan = '';
      $redirectUrl = "/user";
      $status = 0;
      if ($req && $ajax) {
        if($id){
          $isKomoditi = Komoditi::model()->findByAttributes(array('id_user'=>$id));
          $isUser = Pengguna::model()->findByAttributes(array('id'=>$id));
          //$isFarmer = TabelPetani::model()->findByAttributes(array('id_user'=>$isUser->username));
          if(!empty($isUser)){
            if(!empty($isUser)){
              if($isUser->status=="0"){
                $status = 1;
                $isUser->status = $status;
                $isUser->id = $id;
                // $isFarmer->status = $status;
                // $isFarmer->id_user = $isUser->username;
                if($isUser->save()){
                  $pesan = 'success';
                  $redirectUrl = "/kospermindo/users/moderator";
                  //$this->redirect('/user/setfarmer');
                }else{
                  $pesan = 'failed';
                  //$this->redirect('site/error', true, 404);
                } 
              }else{
                $isUser->status = $status;
                $isUser->id = $id;
                // $isFarmer->status = $status;
                // $isFarmer->id_user = $isUser->username;
                if($isUser->save()){
                  $pesan = 'success';
                  Yii::app()->user->setFlash('success','Data berhasil dihapus');
                  $redirectUrl = "/kospermindo/users/moderator";
                  //$this->redirect('/user/setfarmer');
                }else{
                  Yii::app()->user->setFlash('error','Data gagal dihapus');
                  $pesan = 'failed';
                  //$this->redirect('site/error', true, 404);
                }  
              }
              $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
              echo CJSON::encode($data);
            }else{
              $this->redirect('site/error', true, 404);
            }
          }elseif (!empty($isKomoditi)) {
            if(!empty($isKomoditi)){
              if($isKomoditi->status=="0"){
                $status = 1;
                $isKomoditi->status = $status;
                $isKomoditi->id_user = $id;
                if($isKomoditi->save()){
                  $pesan = 'success';
                  $redirectUrl = "/kospermindo/users/panen";
                }else{
                  $pesan = 'failed';
                } 
              }else{
                $isKomoditi->status = $status;
                $isKomoditi->id = $id;
                if($isKomoditi->save()){
                  $pesan = 'success';
                  $redirectUrl = "/kospermindo/users/panen";
                }else{
                  $pesan = 'failed';
                }  
              }
              $data = array('message' => $pesan, 'redirect_url' => $redirectUrl);
              echo CJSON::encode($data);
            }else{
              $this->redirect('site/error', true, 404);
            }
          }
        }else{
          //kirim redirect data bukan $id
        }
      }else{
        echo CJSON::encode(array('message' => 'Your request is invalid'));
      }
    }

    public function actionGudang(){
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
          $findGroup[] = Kelompok::model()->findByAttributes(array('id'=>$findUsername[$i]['id']));
        }
        $komoditi = Komoditi::model()->findAllByAttributes(array('status'=>1));
        //Helper::dd($komoditi);
        $apa[]=0;
        foreach ($komoditi as $value) {
          $apa[]+=$value->total_panen;
        }

        //for profile 2
        $groupData = Kelompok::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

        //for profile 3
        $warehouseData = Gudang::model()->findAllByAttributes(array('id'=>Yii::app()->user->id));
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
      $this->render('warehouse', array(
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
    public function actionGroups(){
       if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }

      $pesan = '';
      $dataProvider = new CActiveDataProvider('Kelompok', array(
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
      
      $this->render('groups', array(
        'data' => $dataProvider,
        'pesan' =>$pesan,
        //'namaKelompok' => $namaKelompok
      ));
    }
    public function actionPetani(){
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/users/login');
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
          $findGroup[] = Kelompok::model()->findByAttributes(array('id_user'=>$findUsername[$i]['username']));
        }
        $komoditi = Komoditi::model()->findAllByAttributes(array('status'=>1));
        //Helper::dd($komoditi);
        $apa[]=0;
        foreach ($komoditi as $value) {
          $apa[]+=$value->total_panen;
        }

        //for profile 2
        $groupData = Kelompok::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

        //for profile 3
        $warehouseData = Gudang::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

        //for profile 4
        //$farmer = TabelPetani::model()->findAllByAttributes(array('id_perusahaan'=>Yii::app()->user->id));
        $petani = TabelPetani::model()->findAll();
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
      $this->render('petani', array(
        'data'     => $data,
        'dataUser' => $dataUser,
        'dataGroup'=>$findGroup,
        'summary' =>$summary,
        'groupData' => $groupData,
        'warehouseData' => $warehouseData,
        'farmer' => $petani,
        'farmerData' =>$farmerData,
        'moderator' =>$moderator
      ));
    }
    public function actionModerator(){
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/users/login');
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
          $findGroup[] = Kelompok::model()->findByAttributes(array('ketua_kelompok'=>$findUsername[$i]['username']));
        }
        $komoditi = Komoditi::model()->findAllByAttributes(array('status'=>1));
        $apa[]=0;
        foreach ($komoditi as $value) {
          $apa[]+=$value->total_panen;
        }

        //for profile 2
        $groupData = Kelompok::model()->findAllByAttributes(array('ketua_kelompok'=>Yii::app()->user->id));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));

        //for profile 3
        $warehouseData = Gudang::model()->findAllByAttributes(array('id_gudang'=>Yii::app()->user->id));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));
        $farmer = Pengguna::model()->findAllByAttributes(array('levelid'=>3));
        $moderator = Pengguna::model()->findAllByAttributes(array('levelid'=>3,'is_moderator'=>1));
        $farmerData = Users::model()->findAllByAttributes(array('isadmin'=>0,'superuser'=>0,'status'=>1,'levelid'=>2,'groupid'=>0,'companyid'=>Yii::app()->user->id));
      } elseif ($users == true) {
        $data = Users::model()->findAllByAttributes(array('status' => 1));
      }
      $summary = Komoditi::model()->getSummarySeaweed();
      $dataProvider = new Users('search');
      $dataProvider->unsetAttributes();
      if (isset($_GET['Users'])) {
        $dataProvider->attributes = $_GET['Users'];
      }
      $this->render('moderator', array(
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
    public function actionPanen(){
      //$komoditi = Komoditi::model()->findAllByAttributes(array('status'=>1));
      $isUser = Pengguna::model()->findAllByAttributes(array('levelid'=>3));
      //$komoditi = Komoditi::model()->getAllPanen();
      $hasilpanen = Komoditi::model()->getpanen();
      $this->render('panen',array(
        'komoditi' =>$hasilpanen
        ));
    }
  }