<?php

  class SearchController extends KController
  {
//    public function filters(){
//      return array(
//        'rights'
//      );
//    }
    public function actionIndex()
    {
      if (Yii::app()->user->isGuest) {
        $this->redirect('/login');
      }
      
      $q = Yii::app()->request->getParam('q');
      $model = new Komoditi('search');
      $model->unsetAttributes();

      if(isset($q)){
        $model->nama_komoditi = $q;
      }
      $this->render('index', array(
        'model'=>$model
      ));
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