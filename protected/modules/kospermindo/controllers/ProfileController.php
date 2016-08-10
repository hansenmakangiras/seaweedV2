<?php

class ProfileController extends KController
{
	public function actionIndex()
	{
    if (Yii::app()->user->isGuest) {
      $this->redirect('/kospermindo/login');
    }
		$id = !empty($_GET['id']) ? $_GET['id'] : '';
		//helper::dd($id);
		if(isset($id)){
      		$profile = Petani::model()->findByAttributes(array('id_petani' => $id));
      		/*$total = Komoditi::model()->getPanenFarmer($profile->id_user);*/

      		$this->render('index',
      			array(
      				'petani' => $profile));
		}
		
	}

	public function actionImage($data)       
	{
		$profile = TabelPetani::model()->findByAttributes("image=:data", array('data' => $data));
		// $image = Images::model()->find('tmp_name=:data', array('id' => $data)); 

		$dest = Yii::getPathOfAlias('application.uploads');

		$file = $dest .'/' . $image->tmp_name . '.' . $image->extension;

		if(file_exists($file)){
		ob_clean();
		header('Content-Type:' . $image->logo_type);
		readfile($file);
		exit;
		}

	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}