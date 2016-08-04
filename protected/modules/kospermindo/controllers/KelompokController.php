<?php

  class KelompokController extends KController
  {
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/kospermindo/login');
      }
      $pesan = '';

      $dataProvider = new CActiveDataProvider('TabelKelompok', array(
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
          'route'    => $this->createUrl('/kospermindo/kelompok'),
        ),
        'sort' => array(
          'multiSort' => false,
          'sortVar' => 'sort',
          'descTag' => 'desc',
          'defaultOrder' => 'nama_kelompok ASC',
          'route' => $this->createUrl('/kospermindo/kelompok'),
          'separators' => '.'
        )
      ));

      $namaGudang = Gudang::model()->findAllByAttributes(array('status' => 1));

      $this->render('index', array(
        'data'       => $dataProvider,
        'namaGudang' => $namaGudang,
      ));
    }

    public function actionBuat()
    {
      $namaKelompok = Yii::app()->request->getPost('namaKelompok');
      $lokasiKelompok = Yii::app()->request->getPost('lokasiKelompok');
      $namaKelompok = Helper::cleanString($namaKelompok);
      if (isset($namaKelompok)) {
        $dataProvider = new TabelKelompok;
        $kelompok = TabelKelompok::model()->findByAttributes(array('nama_kelompok' => ucfirst($namaKelompok)));
        $gudang = Gudang::model()->findByAttributes(array('id' => $lokasiKelompok));
        $kelompokGudang = TabelKelompok::model()->findByAttributes(array(
          'nama_kelompok' => ucfirst($namaKelompok),
          'idgudang'      => $lokasiKelompok,
        ));
        $kelompok = !empty($kelompok) ? $kelompok : array();

        if (empty($kelompokGudang)) {
          $dataProvider->nama_kelompok = ucfirst($namaKelompok);
          $dataProvider->idgudang = $lokasiKelompok;
          $dataProvider->status = 1;
          if ($dataProvider->save()) {
            Yii::app()->user->setFlash('success', 'Data berhasil disimpan');
            $this->redirect('/kospermindo/kelompok');
          }
        } else {
          Yii::app()->user->setFlash('error', 'Data Kelompok : ' . $namaKelompok . ' sudah terdaftar');
          $this->redirect('/kospermindo/kelompok');
        }
      }
    }

    public function actionUbah()
    {
      $id = Yii::app()->request->getParam('id');
      if ($id) {
        //check in coordinator table
        $isKelompok = TabelKelompok::model()->findByAttributes(array('id' => $id));
        $namaGudang = Gudang::model()->findByAttributes(array('id' => $isKelompok->idgudang));
        if (!empty($isKelompok)) {
          $pesan = '';
          if ((isset($_POST['TabelKelompok']))) {
            $isKelompok->attributes = $_POST['TabelKelompok'];
            $isKelompok->id = $id;
            if ($isKelompok->save()) {
              $pesan = 'Data berhasil disimpan';
              Yii::app()->user->setFlash('success', 'Data berhasil di perbaharui');
              $this->redirect('/kospermindo/kelompok');
            } else {
              Yii::app()->user->setFlash('success', 'Data gagal di perbaharui');
              $pesan = 'Data Gagal disimpan';
            }
          }
        }
      }
      $this->render('update', array(
        'model_kelompok' => $isKelompok,
        'pesan'          => $pesan,
        'namaGudang'          => $namaGudang,
      ));
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
          $isKelompok = TabelKelompok::model()->findByAttributes(array('id' => $id));
          if (!empty($isKelompok)) {
            $isKelompok->status = $status;
            $isKelompok->id = $id;
            if ($isKelompok->save()) {
              $pesan = 'success';
              Yii::app()->user->setFlash('success', 'Data berhasil Dihapus');
              $redirectUrl = "/kospermindo/kelompok";
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

    public function actionDetail()
    {
      $id = $_GET['id'];
      if($id){
        $model = TabelKelompok::model()->findAllByAttributes(array('idgudang' => (int) $id));

      }
      $this->render('showFarmers', array(
        'model' => $model
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
     * @return TabelKelompok the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
      $model = TabelKelompok::model()->findByPk($id);
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
