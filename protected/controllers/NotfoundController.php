<?php

  /**
   * Created by Sublime Text.
   * User: Ray
   * Date: 6/13/2016
   * Time: 03:32 PM
   */
  class NotfoundController extends Controller
  {

    /* Set global layout for all actions */
    public $layout = '//layouts/singlepage';

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
      // renders the view file 'protected/views/login/index.php'
      // using the default layout 'protected/views/layouts/singlepage.php'
      $this->render('index', array(
      ));
    }
  }