<?php

  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 5/25/2016
   * Time: 12:04 AM
   */
  class ForgotController extends SController
  {

    /* Set global layout for all actions */
    public $layout = '/layouts/singlepage';

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
      // renders the view file 'protected/views/login/index.php'
      // using the default layout 'protected/views/layouts/singlepage.php'
      $this->render('index', array());
    }
    public function actionSentEmail(){
      # Response Data Array
      $resp = array();

      // Fields Submitted
      $email = $_POST["email"];

      // This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
      $resp['submitted_data'] = $email;

      echo json_encode($resp);
    }
  }