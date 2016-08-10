<?php

  class SuperadminModule extends CWebModule
  {
    public $tableUsers = 'users';
    public $userColumn = 'Users';
    public $userId = 'id';
    public $isAdmin = true;
    public $layout = 'superadmin.views.layouts.main';
    public $appLayout = 'application.modules.superadmin.views.layouts.main';
    public $baseUrl = '/superadmin';
    public $install = false;
    public $debug = false;

    private $_assetsUrl;

    public function init()
    {
      // this method is called when the module is being created
      // you may place code here to customize the module or the application
      //$this->baseUrl = Yii::app()->getBaseUrl(true);
      //$this->defaultController = "dashboard";
      // import the module-level models and components
      $this->setImport(array(
        'superadmin.models.*',
        'superadmin.components.*',
        'superadmin.modules.rights.*',
        'superadmin.modules.rights.components.*',
        'superadmin.modules.rights.components.dataproviders.*',
      ));
      parent::init();
      Yii::app()->setComponents(array(
        'errorHandler' => array(
          // use 'site/error' action to display errors
          'errorAction' => YII_DEBUG ? null : '/superadmin/error',
        ),
        'user'         => array(
          'class'          => 'SAdminWebUser',
          // enable cookie-based authentication
          'allowAutoLogin'      => true,
          'loginUrl'            => '/superadmin/login',
          'authTimeout'         => 2592000,
          //'absoluteAuthTimeout' => 2592000,
          //'baseUrl'=>Yii::app()->createUrl("/kospermindo/login"),
          'stateKeyPrefix' => '_superadmin',
        ),
      ));
      //$this->setModules(array('rights'));
    }

    public function beforeControllerAction($controller, $action)
    {
      if (parent::beforeControllerAction($controller, $action)) {
        // this method is called before any module controller action is performed
        // you may place customized code here
        //if(Yii::app()->user->isSuperUser){

          return true;
        //}
        //Yii::app()->request->redirect('/superadmin/login');
      } else {
        return false;
      }

    }

//    public function afterControllerAction($controller, $action){
//      if (parent::afterControllerAction($controller, $action)) {
//        // this method is called before any module controller action is performed
//        // you may place customized code here
//        if(!Yii::app()->user->isGuest && !Yii::app()->user->checkAccess('SuperAdmin')){
//          return true;
//        }
//        //Yii::app()->request->createUrl('/superadmin/login');
//        throw new exception("You are not authorize to access this.", 403);
//      } else {
//        return false;
//      }
//    }

    /**
     * Publishes the module assets path.
     * @return string the base URL that contains all published asset files of Rights.
     */
    public function getAssetsUrl()
    {
      if ($this->_assetsUrl === null) {
        $assetsPath = Yii::getPathOfAlias('superadmin.assets');

        // We need to republish the assets if debug mode is enabled.
        if ($this->debug === true) {
          $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
        } else {
          $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
        }
      }

      return $this->_assetsUrl;
    }
  }
