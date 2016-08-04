<?php

class PengaturanController extends KController
{

	public function actionIndex()
	{
    if (Yii::app()->user->isGuest) {
      $this->redirect('/kospermindo/login');
    }
    $model = new Settings;
    $request = Yii::app()->request->getIsPostRequest();

    if($request){
      if(isset($_POST['Settings'])){
        $settings = $_POST['Settings'];
        $model->attributes = $settings;
        $model->site_title = $settings['site-name'];
        $model->site_url = $settings['site-url'];
        $model->email = $settings['email'];
        $model->help_desk_phone = $settings['phone'];
        $model->jumlah_bal = $settings['jumlah-bal'];
        $model->nilai_tetap = $settings['nilai-tetap'];
        $model->biaya_proses = $settings['biaya-proses'];
        $model->biaya_container = $settings['biaya-kontainer'];

        //Helper::dd($settings);
        if($model->save()){
          Yii::app()->user->setFlash('success','Data berhasil disimpan');
        }else{
          Helper::dd($model->errors);
          Yii::app()->user->setFlash('error','Data gagal disimpan');
        }
      }
    }
		$this->render('index');
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