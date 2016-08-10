<?php

  class GudangController extends KController

  {
    public function actionIndex()
    {
      //$this->layout = '/layouts/main';
      $this->layout = '/layouts/Column1';

      if (Yii::app()->user->isGuest) {

        $this->redirect('/kospermindo/login');

      } else {

        $dataProvider = new CActiveDataProvider('Gudang', array(

          'criteria' => array(

            'condition' => 'status=1',

            'order' => 'id_gudang ASC',

          ),

          'countCriteria' => array(

            'condition' => 'status=1',

          ),

          'pagination' => array(

            'pageSize' => 10,

            'pageVar' => 'hal',

            'route' => $this->createUrl('/kospermindo/gudang'),

          ),

          'sort' => array(

            'multiSort' => false,

            'sortVar' => 'sort',

            'descTag' => 'desc',

            'defaultOrder' => 'nama ASC',

            'route' => $this->createUrl('/kospermindo/gudang'),

            'separators' => '.',

          ),

        ));

        $this->render('index', array(
          'data' => $dataProvider,
        ));

      }

    }

    public function actionUbahAjax()
    {

      $nama_gudang = $_POST['nama_gudang'];

      $tel = $_POST['tel'];

      $luas_gudang = $_POST['luas_gudang'];

      $alamat = $_POST['alamat'];

      $provinsi = $_POST['provinsi'];

      $kabupaten = $_POST['kabupaten'];

      $namaProvinsi = Provinsi::model()->findByAttributes(array('provinsi_id' => $provinsi));

      $namaKab = Kotakab::model()->findByAttributes(array('kota_id' => $kabupaten));

      $pj_gudang = !empty($_POST['pj_gudang']) ? $_POST['pj_gudang'] : '';
      $alamatLengkap = $alamat . ", " . $namaKab->kokab_nama . ", " . $namaProvinsi->provinsi_nama;

      $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($alamatLengkap) . '&sensor=false');

      $geo = CJSON::decode($geo);

      if (isset($geo) && $geo['status'] !== 'ZERO_RESULTS') {
        //$geo = json_encode($geo,true);
        //$lu = !empty($geo['results']) ? $geo['results'][0]['geometry']['location']['lat'] : null;
        //$ls = !empty($geo['results']) ? $geo['results'][0]['geometry']['location']['lng'] : null;
        //Helper::dd($geo);
        $lu = $geo['results'][0]['geometry']['location']['lat'];
        $ls = $geo['results'][0]['geometry']['location']['lng'];
      } else {

        $lu = null;

        $ls = null;
      }

      $gudang = new Gudang;

      $gudangHistory = new GudangHistory;

      $status = 1;

      $pesan = '';

      if (isset($nama_gudang) && isset($tel) && isset($luas_gudang) && isset($alamat) && isset($provinsi) && isset($kabupaten)) {

        $gudang->nama = $nama_gudang;

        $gudang->alamat = $alamat;

        $gudang->kabupaten = $namaKab->kota_id;

        $gudang->provinsi = $namaProvinsi->provinsi_id;

        $gudang->latitude = $ls;

        $gudang->longitude = $lu;

        $gudang->luas = $luas_gudang;

        $gudang->telp = $tel;

        $gudang->status = $status;

        $gudang->koordinator = $pj_gudang;

        if ($gudang->save()) {

          $gudangHistory->id_gudang = $gudang->id_gudang;

          $gudangHistory->nama = $gudang->nama;

          $gudangHistory->alamat = $gudang->alamat;

          $gudangHistory->kabupaten = $gudang->kabupaten;

          $gudangHistory->provinsi = $gudang->provinsi;

          $gudangHistory->latitude = $gudang->latitude;

          $gudangHistory->longitude = $gudang->longitude;

          $gudangHistory->luas = $gudang->luas;

          $gudangHistory->telp = $gudang->telp;

          $gudangHistory->status = $gudang->status;

          $gudangHistory->koordinator = $gudang->koordinator;

          $gudangHistory->created_date = date('Y-m-d H:i:s');

          $created_by = Yii::app()->user->id;

          $gudangHistory->created_by = $created_by;

          if ($gudangHistory->save()) {

            $pesan = 'success';

            Yii::app()->user->setFlash('success', 'Data berhasil Disimpan');

            $this->redirect('/kospermindo/gudang');

          } else {

            Yii::app()->user->setFlash('error', 'Data Gagal disimpan');

            $pesan = 'invalid';

          }


        } else {

          Yii::app()->user->setFlash('error', 'Data Gagal disimpan');

          $pesan = 'invalid';
        }
      }

    }

    public function actionUpdateField()
    {
      $req = Yii::app()->request->getIsPostRequest();
      $ajax = Yii::app()->request->getIsAjaxRequest();
      $pid = Yii::app()->request->getPost('id');
      $arr_gudang = array();
      if (!$req && !$ajax) {
        throw new CHttpException(403, 'Your request is not valid POST');
      } else {
        if (isset($pid) || $pid !== null) {
          $gudang = Gudang::model()->findByPk((int)$pid);
          echo CJSON::encode($gudang);
        }
      }
    }

    public function actionGetprov()
    {
      $req = Yii::app()->request->getIsPostRequest();
      $ajax = Yii::app()->request->getIsAjaxRequest();
      $pid = Yii::app()->request->getPost('id');
      $provinsi = array();
      if (!$req && !$ajax) {
        throw new CHttpException(403, 'Your request is not valid POST');
      } else {
        $prov = Provinsi::model()->findAll();
        foreach ($prov as $key => $value) {
          $provinsi[$key] = $value;
        };
        echo CJSON::encode($provinsi);
      }
    }

    public function actionGetkota()
    {
      $prov = !empty($_POST['prov']) ? $_POST['prov'] : '';

      $getProv = Provinsi::model()->findByPk((int)$prov);

      $getKota = Kotakab::model()->findAllByAttributes(array('provinsi_id' => $getProv['provinsi_id']));

      $kota = array();

      foreach ($getKota as $key => $value) {
        $kota[$key] = $value;
//        array_push($kota, $value->kokab_nama);
      };

      echo CJSON::encode($kota);

    }

    public function actionTambah()
    {

      $nama_gudang = $_POST['nama_gudang'];

      $tel = $_POST['tel'];

      $luas_gudang = $_POST['luas_gudang'];

      $alamat = $_POST['alamat'];

      $provinsi = $_POST['provinsi'];

      $kabupaten = $_POST['kabupaten'];

      $namaProvinsi = Provinsi::model()->findByAttributes(array('provinsi_id' => $provinsi));

      $namaKab = Kotakab::model()->findByAttributes(array('kota_id' => $kabupaten));

      $pj_gudang = !empty($_POST['pj_gudang']) ? $_POST['pj_gudang'] : '';
      $alamatLengkap = $alamat . ", " . $namaKab->kokab_nama . ", " . $namaProvinsi->provinsi_nama;

      $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($alamatLengkap) . '&sensor=false');

      $geo = CJSON::decode($geo);

      if (isset($geo) && $geo['status'] !== 'ZERO_RESULTS') {
        //$geo = json_encode($geo,true);
        //$lu = !empty($geo['results']) ? $geo['results'][0]['geometry']['location']['lat'] : null;
        //$ls = !empty($geo['results']) ? $geo['results'][0]['geometry']['location']['lng'] : null;
        //Helper::dd($geo);
        $lu = $geo['results'][0]['geometry']['location']['lat'];
        $ls = $geo['results'][0]['geometry']['location']['lng'];
      } else {

        $lu = null;

        $ls = null;
      }

      $gudang = new Gudang;

      $gudangHistory = new GudangHistory;

      $status = 1;

      $pesan = '';

      if (isset($nama_gudang) && isset($tel) && isset($luas_gudang) && isset($alamat) && isset($provinsi) && isset($kabupaten)) {

        $gudang->nama = $nama_gudang;

        $gudang->alamat = $alamat;

        $gudang->kabupaten = $namaKab->kota_id;

        $gudang->provinsi = $namaProvinsi->provinsi_id;

        $gudang->latitude = $ls;

        $gudang->longitude = $lu;

        $gudang->luas = $luas_gudang;

        $gudang->telp = $tel;

        $gudang->status = $status;

        $gudang->koordinator = $pj_gudang;

        if ($gudang->save()) {

          $gudangHistory->id_gudang = $gudang->id_gudang;

          $gudangHistory->nama = $gudang->nama;

          $gudangHistory->alamat = $gudang->alamat;

          $gudangHistory->kabupaten = $gudang->kabupaten;

          $gudangHistory->provinsi = $gudang->provinsi;

          $gudangHistory->latitude = $gudang->latitude;

          $gudangHistory->longitude = $gudang->longitude;

          $gudangHistory->luas = $gudang->luas;

          $gudangHistory->telp = $gudang->telp;

          $gudangHistory->status = $gudang->status;

          $gudangHistory->koordinator = $gudang->koordinator;

          $gudangHistory->created_date = date('Y-m-d H:i:s');

          $created_by = Yii::app()->user->id;

          $gudangHistory->created_by = $created_by;

          if ($gudangHistory->save()) {

            $pesan = 'success';

            Yii::app()->user->setFlash('success', 'Data berhasil Disimpan');

            $this->redirect('/kospermindo/gudang');

          } else {

            Yii::app()->user->setFlash('error', 'Data Gagal disimpan');

            $pesan = 'invalid';

          }


        } else {

          Yii::app()->user->setFlash('error', 'Data Gagal disimpan');

          $pesan = 'invalid';
        }
      }

    }

    public function actionHapus()
    {

      $req = Yii::app()->request->getIsPostRequest();

      $ajax = Yii::app()->request->getIsAjaxRequest();

      $id = Yii::app()->request->getPost('id');

      $pesan = '';

      $redirectUrl = "/user";

      $status = 0;

      if ($req && $ajax) {

        if ($id) {

          $isGudang = Gudang::model()->findByAttributes(array('id_gudang' => $id));

          if (!empty($isGudang)) {

            $isGudang->status = $status;

            if ($isGudang->save()) {

              $pesan = 'success';

              Yii::app()->user->setFlash('success', 'Data berhasil Dihapus');

              $redirectUrl = "/kospermindo/gudang";

            } else {

              Yii::app()->user->setFlash('error', 'Data Gagal Dihapus');

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

    public function actionBatchUpdate()
    {
      // retrieve items to be updated in a batch mode
      // assuming each item is of model class 'Item'
      $items = $this->getItemsToUpdate();
      if(isset($_POST['Item']))
      {
        $valid=true;
        foreach($items as $i=>$item)
        {
          if(isset($_POST['Item'][$i]))
            $item->attributes=$_POST['Item'][$i];
          $valid=$item->validate() && $valid;
        }
        if($valid){ // all items are valid
          // ...do something here
        }
    }
      // displays the view to collect tabular input
      $this->render('batchUpdate',array('items'=>$items));
    }

    public function actionUbah()
    {
      $nama_gudang = !empty($_POST['nama_gudang']) ? $_POST['nama_gudang'] : '';

      $pj_gudang = !empty($_POST['pj_gudang']) ? $_POST['pj_gudang'] : '';

      $telp = !empty($_POST['tel']) ? $_POST['tel'] : '';

      $luas_gudang = !empty($_POST['luas_gudang']) ? $_POST['luas_gudang'] : '';

      $alamat = !empty($_POST['alamat']) ? $_POST['alamat'] : '';

      $kabupaten = !empty($_POST['kabupaten']) ? $_POST['kabupaten'] : '';

      $provinsi = !empty($_POST['provinsi']) ? $_POST['provinsi'] : '';

      $id = !empty($_POST['id']) ? $_POST['id'] : '';


      //Helper::dd($_POST);
      $gudang = Gudang::model()->findByAttributes(array('id_gudang'=>$id));

      $gudangHistory = new GudangHistory;

      $id_kabupaten = Kotakab::model()->findByAttributes(array('kokab_nama'=>$kabupaten));

      $id_provinsi = Provinsi::model()->findByAttributes(array('provinsi_nama'=>$provinsi));


      $gudang->nama = $nama_gudang;

      $gudang->alamat = $alamat;

      $gudang->kabupaten = $id_kabupaten->kota_id;

      $gudang->provinsi = $id_provinsi->provinsi_id;

      $gudang->luas = $luas_gudang;

      $gudang->telp = $telp;

      $gudang->status = 1;

      $gudang->koordinator = $pj_gudang;

      if($gudang->save()){

        $gudangHistory->id_gudang = $gudang->id_gudang;

        $gudangHistory->nama = $gudang->nama;

        $gudangHistory->alamat = $gudang->alamat;

        $gudangHistory->kabupaten = $gudang->kabupaten;

        $gudangHistory->provinsi = $gudang->provinsi;

        $gudangHistory->luas = $gudang->luas;

        $gudangHistory->telp = $gudang->telp;

        $gudangHistory->status = $gudang->status;

        $gudangHistory->koordinator = $gudang->koordinator;

        $gudangHistory->created_date = date('Y-m-d H:i:s');

        $created_by = Yii::app()->user->id;

        $gudangHistory->created_by = $created_by;

        if($gudangHistory->save()){

          $pesan = array('message'=>'success');

        }else{

          $pesan = array('message'=>'failed');

        }


      }else{

        $pesan = array('message'=>'failed');
      }

      echo json_encode($pesan);
    }

  }
