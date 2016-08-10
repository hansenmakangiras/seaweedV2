<?php

  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 5/25/2016
   * Time: 12:04 AM
   */
  class ErrorController extends SController
  {

    /* Set global layout for all actions */
    //public $layout = '/layouts/singlepage';

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
      // renders the view file 'protected/views/login/index.php'
      // using the default layout 'protected/views/layouts/singlepage.php'
      if ($error = Yii::app()->errorHandler->error) {
        if (Yii::app()->request->isAjaxRequest) {
          echo $error['message'];
        } else {
          $this->render('error', $error);
        }
      }
    }
  }