<?php

class HargaController extends KController
{

	public function filters()
	{

	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','hapus'),
				'users'=>array('vero'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new HargaSeaweed;
		$modelHistory = new HargaSeaweedHistory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HargaSeaweed']))
		{
		//$numberFormatter = new CNumberFormatter(Yii::app()->getLocale('id'));
		$post = $_POST['HargaSeaweed'];
		$exist = HargaSeaweed::model()->exists('id_jenis_komoditi = :id', array(':id' => $post['id_jenis_komoditi']));
			$model->attributes=$post;
		if(!$exist){
		$harga = str_replace(',','', $post['harga']);
		$model->harga = $harga;
		if($model->save()){
			$modelHistory->id_harga_seaweed = $model->id;
			$modelHistory->id_jenis_komoditi = $model->id_jenis_komoditi;
			$modelHistory->harga = $harga;
			$modelHistory->status = $model->status;

			if($modelHistory->save()){
			$this->redirect(array('view','id'=>$model->id));
			}else{
			//Helper::dd($modelHistory->getErrors());
			Yii::app()->user->setFlash('error','Data gagal tersimpan');
			}
		}else{
			//Helper::dd($model->getErrors());
			Yii::app()->user->setFlash('error','Data gagal tersimpan');
		}
		}else{
		Yii::app()->user->setFlash('error','Data sudah ada');
		}

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelHistory = $this->loadModelHistory($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HargaSeaweed']))
		{
			$post = $_POST['HargaSeaweed'];
		$model->attributes=$_POST['HargaSeaweed'];
		$exist = HargaSeaweed::model()->exists('id_jenis_komoditi = :id',array(':id' => $post['id_jenis_komoditi']));
		if(!$exist){
		$harga = str_replace(',','', $post['harga']);
		$model->harga = $harga;
		if($model->save()){
			$modelHistory->setScenario('create');
			$modelHistory->id_harga_seaweed = $model->id;
			$modelHistory->id_jenis_komoditi = $model->id_jenis_komoditi;
			$modelHistory->harga = $harga;
			$modelHistory->status = $model->status;

			if($modelHistory->save()){
			$this->redirect(array('view','id'=>$model->id));
			}else{
			//Helper::dd($modelHistory->getErrors());
			Yii::app()->user->setFlash('error','Data gagal tersimpan');
			}
			$this->redirect(array('view','id'=>$model->id));

		}
		}else{
		Yii::app()->user->setFlash('error','Jenis komoditi sudah ada harga');
		}

		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$this->loadModelHistory($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	public function actionHapus()
	{
		$req = Yii::app()->request->getIsPostRequest();
		$ajax = Yii::app()->request->getIsAjaxRequest();
		$id = Yii::app()->request->getPost('id');
		$pesan = '';
		$redirectUrl = "/kospermindo/harga";
		$status = 1;
		if ($req && $ajax) {
			if ($id) {
			$model = $this->loadModel($id);
			$modelHistory = new HargaSeaweedHistory;
			if (null !== $model || count($model) !== 0) {
				$model->status = $status;
				$model->id_jenis_komoditi = "";
				if ($model->save()) {
				$harga = str_replace(',','', $model->harga);
				$modelHistory->setScenario('create');
				$modelHistory->id_harga_seaweed = $model->id;
				$modelHistory->id_jenis_komoditi = $model->id_jenis_komoditi;
				$modelHistory->harga = $harga;
				$modelHistory->status = $status;
				$modelHistory->created_date = date('Y-m-d H:i:s');
				$created_by = Yii::app()->user->id;
				$modelHistory->created_by = $created_by;
				if($modelHistory->save()){
					$pesan = 'success';
					Yii::app()->user->setFlash('success', 'Data berhasil Dihapus');
					$redirectUrl = "/kospermindo/harga";
				}else{
					//Helper::dd($modelHistory->getErrors());
					Yii::app()->user->setFlash('error', 'Data History gagal disimpan');
					$pesan = 'invalid';
				}
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
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if (Yii::app()->user->isGuest) {
			$this->redirect('/kospermindo/login');
		}else if(Yii::app()->user->akses == 1 || (Yii::app()->user->akses == 2 && in_array("5", json_decode(Users::model()->getModeratorMenu(Yii::app()->user->id))))){

			$jenKom = HargaSeaweed::model()->getJenisKomoditi();
			$jenis_komoditi = JenisKomoditi::model()->findAllByAttributes(array('status'=>0));
			$harga_komoditi = HargaSeaweed::model()->findAllByAttributes(array('status'=>0));
			$dataProvider = new CActiveDataProvider('HargaSeaweed', array(
				'criteria'      => array(
				'condition' => 'status=0',
				'order'     => 'id ASC',
				),
				'countCriteria' => array(
				'condition' => 'status = 0',
				),
				'pagination'    => array(
				'pageSize' => 10,
				'pageVar'  => 'hal',
				'route'    => $this->createUrl('/kospermindo/harga'),
				),
				'sort'          => array(
				'multiSort'    => false,
				'sortVar'      => 'sort',
				'descTag'      => 'desc',
				'defaultOrder' => 'id ASC',
				'route'        => $this->createUrl('/kospermindo/harga'),
				'separators'   => '.',
				),
			));

			$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'jenis_komoditi' => $jenKom
			));
		}else{
			$this->redirect('/kospermindo');
		}
	}

	public function actionTambah(){
		$id_jenis_komoditi = !empty($_POST['id_komoditi']) ? $_POST['id_komoditi'] : '';
		$harga = !empty($_POST['harga']) ? str_replace(',','', $_POST['harga']) : '';
		
		$harga_komoditi = new HargaSeaweed;
		$harga_komoditi_his = new HargaSeaweedHistory;

		$status = 0;
		$pesan = '';

		$get_same_komoditi = HargaSeaweed::model()->findByAttributes(
			array('id_jenis_komoditi'=>$id_jenis_komoditi));
		if(empty($get_same_komoditi)){
			if(isset($id_jenis_komoditi) && isset($harga)){
				$harga_komoditi->id_jenis_komoditi = $id_jenis_komoditi;
				$harga_komoditi->harga = $harga;
				$harga_komoditi->status = $status;
				if($harga_komoditi->save()){
					$harga_komoditi_his->id_harga_seaweed = $harga_komoditi->id;
					$harga_komoditi_his->id_jenis_komoditi = $harga_komoditi->id_jenis_komoditi;
					$harga_komoditi_his->harga = $harga_komoditi->harga;
					$harga_komoditi_his->status = $harga_komoditi->status;
					$harga_komoditi_his->created_date = date('Y-m-d H:i:s');
					$created_by = Yii::app()->user->id;
					$harga_komoditi_his->created_by = $created_by;
					if($harga_komoditi_his->save()){
						Yii::app()->user->setFlash('success', 'Harga Komoditi berhasil di simpan');
						$pesan = array('message'=>'success');	
					}else{
						$pesan = array('message'=>'failed');
					}
				}else{
					$pesan = array('message'=>'failed');
				}
			}
		}else{
			$pesan = array('message'=>'double');
		}
		echo json_encode($pesan);
	}

	public function actionGetdetailharga(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';
		$harga_seaweed = HargaSeaweed::model()->findByAttributes(array('id'=>$id));
		$jenis_komoditi = JenisKomoditi::model()->findByAttributes(array('id_komoditi'=>$harga_seaweed['id_jenis_komoditi']));

		$pesan = array(
				'id' => $harga_seaweed['id'],
				'id_jenis_komoditi' => $harga_seaweed['id_jenis_komoditi'],
				'jenis_komoditi' => $jenis_komoditi['jenis'],
				'harga' => $harga_seaweed['harga'],
			);
		echo json_encode($pesan);
	}

	public function actionUbah(){
		$id_jenis_komoditi = !empty($_POST['id_komoditi']) ? $_POST['id_komoditi'] : '';
		$harga = !empty($_POST['harga']) ? str_replace(',','', $_POST['harga']) : '';
		$id = !empty($_POST['id']) ? $_POST['id'] : '';

		$harga_seaweed = HargaSeaweed::model()->findByAttributes(array('id'=>$id));
		$harga_komoditi_his = new HargaSeaweedHistory;
		$harga_seaweed->status = 0;
		$harga_seaweed->harga = $harga;
		if($harga_seaweed->save()){
			$harga_komoditi_his->id_harga_seaweed = $id;
			$harga_komoditi_his->id_jenis_komoditi = $harga_seaweed->id_jenis_komoditi;
			$harga_komoditi_his->harga = $harga_seaweed->harga;
			$harga_komoditi_his->status = $harga_seaweed->status;
			$harga_komoditi_his->created_date = date('Y-m-d H:i:s');
			$created_by = Yii::app()->user->id;
			$harga_komoditi_his->created_by = $created_by;
			if ($harga_komoditi_his->save()) {
				Yii::app()->user->setFlash('success', 'Harga Komoditi berhasil di perbaharui');
				$pesan = array('message' => 'success');
				} else {
					$pesan = array('message' => 'failed');
				}
		}else{
			$pesan = array('message' => 'failed');
		}
		echo json_encode($pesan);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HargaSeaweed('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HargaSeaweed']))
			$model->attributes=$_GET['HargaSeaweed'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HargaSeaweed the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HargaSeaweed::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HargaSeaweedHistory the loaded model
	 * @throws CHttpException
	 */
	public function loadModelHistory($id)
	{
	$model=HargaSeaweedHistory::model()->findByPk($id);
	if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
	return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param HargaSeaweed $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='harga-seaweed-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGrafik(){
		$id = !empty($_GET['id']) ? $_GET['id'] : '';
		$harga_seaweed = HargaSeaweed::model()->findByAttributes(array('id'=>$id));
		$this->render('grafik',array(
			'id' => $harga_seaweed->id
			));
	}

	public function actionGrafikperubahanharga(){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';
		$harga_komoditi_his = HargaSeaweedHistory::model()->getHargaHistory($id);
		$harga = array();
		$i=1;

		foreach ($harga_komoditi_his as $key => $value) {
			$harga[] = array('id'=>$i++,'created_date'=>$value['created_date'],'harga'=>$value['harga']);
		}

		echo json_encode($harga);
	}
}
