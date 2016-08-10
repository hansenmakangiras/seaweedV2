<?php



  class KelompokController extends KController

  {

    public function actionIndex()

    {

      if (Yii::app()->user->isGuest) {

        $this->redirect('/kospermindo/login');

      }

      $pesan = '';



      $dataProvider = new CActiveDataProvider('Kelompok'

        , array(

        'criteria'      => array(

          'condition' => 'status=1',

          'order'     => 'id_kelompok ASC',

        ),

        'countCriteria' => array(

          'condition' => 'status=1',

        ),

        'pagination'    => array(

          'pageSize' => 10,

          'pageVar'  => 'hal',

          'route'    => $this->createUrl('/kospermindo/kelompok'),

        ),

        'sort' => array(

          'multiSort' => false,

          'sortVar' => 'sort',

          'descTag' => 'desc',

          'defaultOrder' => 'nama_kelompok ASC',

          'route' => $this->createUrl('/kospermindo/kelompok'),

          'separators' => '.'

        ))

        );



      $namaGudang = Gudang::model()->findAllByAttributes(array('status' => 1));


      $this->render('index', array(

        'data'       => $dataProvider,

        'namaGudang' => $namaGudang,

      ));

    }

    public function actionGetNamaGudang(){

        $gudang = Gudang::model()->findAllByAttributes(array('status'=>1));

        $isGudang = array();

        foreach ($gudang as $key => $value) {

            array_push($isGudang, $value->nama);

        };

        echo json_encode($isGudang);

    }

    public function actionGetPetani(){
    	$nama_gudang = !empty($_POST['nama_gudang']) ? $_POST['nama_gudang'] : '';

    	$gudang = Gudang::model()->model()->findByAttributes(array('nama'=>$nama_gudang));

    	$petani = Petani::model()->findAllByAttributes(array('id_gudang'=>$gudang->id_gudang));

    	$petaniAll = array();

		foreach ($petani as $key => $value) {

			array_push($petaniAll, $value->nama_petani);

		};

		echo json_encode($petaniAll);
    }



    public function actionTambah()

    {

      $nama_kelompok = !empty($_POST['nama_kelompok']) ? $_POST['nama_kelompok'] : '';

      $nama_gudang = !empty($_POST) ? $_POST['nama_gudang'] : '';

      $ketua_kelompok = !empty($_POST['ketua_kelompok']) ? $_POST['ketua_kelompok'] : '';

      $kelompok = new Kelompok;

      $kelompokHistory = new KelompokHistory;

      $status = 1;

      $pesan = '';

      if(isset($nama_kelompok) && isset($nama_gudang)){

        $isGudang = Gudang::model()->findByAttributes(array('nama'=>$nama_gudang));

        $kelompok->nama_kelompok = $nama_kelompok;

        $kelompok->id_gudang = $isGudang->id_gudang;

        $kelompok->ketua_kelompok = $ketua_kelompok;

        $kelompok->status = $status;

        if($kelompok->save()){

            $kelompokHistory->id_kelompok = $kelompok->id_kelompok;

            $kelompokHistory->nama_kelompok = $kelompok->nama_kelompok;

            $kelompokHistory->id_gudang = $kelompok->id_gudang;

            $kelompokHistory->ketua_kelompok = $kelompok->ketua_kelompok;

            $kelompokHistory->status = $kelompok->status;

            $kelompokHistory->created_date = date('Y-m-d H:i:s');

            $created_by = Yii::app()->user->id;

            $kelompokHistory->created_by = $created_by;

            if($kelompokHistory->save()){

                $pesan = 'success';

                Yii::app()->user->setFlash('success','Data berhasil Disimpan');

                $this->redirect('/kospermindo/kelompok'); 

            }else{

                Yii::app()->user->setFlash('error','Data Gagal disimpan');

                $this->redirect('/kospermindo/kelompok');

                $pesan = 'invalid';
            }
        }else{

            Yii::app()->user->setFlash('error','Data Gagal disimpan');

            $this->redirect('/kospermindo/kelompok');

            $pesan = 'invalid';

        }

      }

    }



    public function actionUbah(){

      $nama_kelompok = !empty($_POST['nama_kelompok']) ? $_POST['nama_kelompok'] : '';

  		$nama_gudang = !empty($_POST['nama_gudang']) ? $_POST['nama_gudang'] : '';

  		$ketua_kelompok = !empty($_POST['ketua_kelompok']) ? $_POST['ketua_kelompok'] : '';

  		$id = !empty($_POST['id']) ? $_POST['id'] : '';

  		$kelompok = Kelompok::model()->findByAttributes(array('id_kelompok'=>$id));

  		$gudang = Gudang::model()->findByAttributes(array('nama'=>$nama_gudang));

  		$petani = Petani::model()->findByAttributes(array('nama_petani'=>$ketua_kelompok));

  		$kelompokHistory = new KelompokHistory;

  		$kelompok->nama_kelompok = $nama_kelompok;

  		$kelompok->ketua_kelompok = $petani->id_petani;

  		$kelompok->id_gudang = $gudang->id_gudang;

  		$kelompok->status = 1;

  		if($kelompok->save()){

  			$kelompokHistory->id_kelompok = $kelompok->id_kelompok;

  	        $kelompokHistory->nama_kelompok = $kelompok->nama_kelompok;

  	        $kelompokHistory->id_gudang = $kelompok->id_gudang;

  	        $kelompokHistory->ketua_kelompok = $kelompok->ketua_kelompok;

  	        $kelompokHistory->status = $kelompok->status;

  	        $kelompokHistory->created_date = date('Y-m-d H:i:s');

  	        $created_by = Yii::app()->user->id;

  	        $kelompokHistory->created_by = $created_by;

  			if($kelompokHistory->save()){

  				$pesan = array('message'=>'success');

  			}else{

  				$pesan = array('message'=>'failed');

  			}
  		 
  		}else{

  		  $pesan = array('message'=>'failed');
  		}

  		echo json_encode($pesan);
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

          $isKelompok = Kelompok::model()->findByAttributes(array('id_kelompok' => $id));

          if (!empty($isKelompok)) {

            $isKelompok->status = $status;

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
