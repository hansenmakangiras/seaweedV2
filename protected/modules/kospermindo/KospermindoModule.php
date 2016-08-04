<?php

  class KospermindoModule extends CWebModule
  {
    /**
     * @property string the path to the layout file to use for displaying Rights.
     */
    public $layout = 'kospermindo.views.layouts.main';
    /**
     * @property string the path to the application layout file.
     */
    public $appLayout = 'application.views.layouts.main';
    public $returnUrl = '/kospermindo';
    private $_assetsUrl;
    public $debug = true;
    public $baseUrl = '/kospermindo';

    /**
     * @property string the style sheet file to use for Rights.
     */
    public function init()
    {
      // this method is called when the module is being created
      // you may place code here to customize the module or the application
      //$this->baseUrl = Yii::app()->getBaseUrl(true);
      // import the module-level models and components
      $this->defaultController = 'dashboard';
      $this->setImport(array(
        'kospermindo.models.*',
        'kospermindo.components.*',
        'application.models.*',
      ));

      parent::init();
      Yii::app()->setComponents(array(
        'errorHandler' => array(
          // use 'site/error' action to display errors
          'errorAction' => YII_DEBUG ? null : '/kospermindo/error',
        ),
        'user'         => array(
          'class'          => 'SWebUser',
          // enable cookie-based authentication
          'allowAutoLogin'      => true,
          'loginUrl'            => '/kospermindo/login',
          'authTimeout'         => 2592000,
          'absoluteAuthTimeout' => 2592000,
          'autoUpdateFlash' => true,
        ),
      ));
    }

    public function beforeControllerAction($controller, $action)
    {
      if (parent::beforeControllerAction($controller, $action)) {
        // this method is called before any module controller action is performed
        // you may place customized code here
        return true;
      } else {
        return false;
      }
    }

    /**
     * Publishes the module assets path.
     * @return string the base URL that contains all published asset files of Rights.
     */
    public function getAssetsUrl()
    {
      if ($this->_assetsUrl === null) {
        $assetsPath = Yii::getPathOfAlias('kospermindo.assets');

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
