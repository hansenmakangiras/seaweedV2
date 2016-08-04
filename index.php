<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//require_once($yii);
//$app = Yii::createWebApplication($config);
//$app->run();

  require_once($yii);

  class ExtendableWebApp extends CWebApplication {
    protected function init() {
      // this example dynamically loads every module which can be found
      // under `modules` directory
      // this can be easily done to load modules
      // based on MySQL db or any other as well
      foreach (glob(dirname(__FILE__).'/protected/modules/*', GLOB_ONLYDIR) as $moduleDirectory) {
        $this->setModules(array(basename($moduleDirectory)));
      }
      return parent::init();
    }
  }

  $app=new ExtendableWebApp($config);
  $app->run();
