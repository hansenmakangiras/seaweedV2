<?php

// uncomment the following to define a path alias
//  Yii::setPathOfAlias('cms', 'application.modules.cms');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
  $config = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'     => 'Panrita',

    // preloading 'log' component
    'preload'  => array('log'),
//    'language' => 'id',

    // autoloading model and component classes
    'import'   => array(
      'application.models.*',
      'application.components.*',
      'application.extensions.*',
//      'application.modules.rights.*',
//      'application.modules.rights.components.*',
//      'application.modules.rights.components.dataproviders.*',
      'application.modules.auditTrail.*',
      'application.modules.auditTrail.components.*',
      'application.modules.auditTrail.models.AuditTrail',
    ),
    'modules'    => array(
      'gii'    => array(
        'class'     => 'system.gii.GiiModule',
        'password'  => 'sembarang',
        'ipFilters' => array('127.0.0.1', '::1'),
      ),
//      'rights' => array(
//        'superuserName'      => 'SuperAdmin',
//        'userClass'          => 'Users',
//        'authenticatedName'  => 'Authenticated',
//        'userIdColumn'       => 'id',
//        'userNameColumn'     => 'username',
//        'baseUrl'            => '/rights',
//        'layout'             => 'rights.views.layouts.main',
//        'appLayout'          => 'application.views.layouts.main',
//        'displayDescription' => false,
//        'install'            => false,
//        'debug'              => true,
//      ),
      //'superadmin'  => array(),
//      'kospermindo'  => array(
//        'baseUrl'            => '/kospermindo',
//        'layout'             => 'kospermindo.views.layouts.main',
//        'appLayout'          => 'application.views.layouts.main',
//      ),
      'auditTrail'  => array(
        'userClass' => 'Users', // the class name for the user object
        'userIdColumn' => 'id', // the column name of the primary key for the user
        'userNameColumn' => 'username', // the column name of the primary key for the user),
      ),
    ),
    // application components
    'components' => array(
      'apns' => array(
        'class' => 'ext.apns-gcm.YiiApns',
        'environment' => 'sandbox',
        'pemFile' => dirname(__FILE__).'/apnssert/apns-dev.pem',
        'dryRun' => false,
        'options' => array(
          'sendRetryTimes' => 5
        ),
      ),
      'gcm' => array(
        'class' => 'ext.apns-gcm.YiiGcm',
        'apiKey' => isset(Yii::app()->params['gcm_api_key']) ? Yii::app()->params['gcm_api_key'] : 'AIzaSyBtNrvs1AVrYrQfYWGKV99HiUJXgCEe36o',
      ),
      'apnsGcm' => array(
        'class' => 'ext.apns-gcm.YiiApnsGcm',
      ),
      // uncomment the following to enable URLs in path-format
      'urlManager'   => array(
        'urlFormat'      => 'path',
        'showScriptName' => false,
        'rules'          => array(
          'role'             => 'rights',
          'users'            => 'user',
          'warehouse'        => 'gudang',
          'warehouse/create' => 'gudang/create',
          'warehouse/update' => 'gudang/update',

          // REST patterns
          array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
          array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
          array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
          array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
          array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),

          '<controller:\w+>/<id:\d+>'              => '<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
          '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
        ),
      ),
      'cache'        => array('class' => 'system.caching.CDummyCache'),
      'session'      => array(
        'sessionName' => 'SeaweedSession',
        'class'       => 'CHttpSession',
        'autoStart'   => true,
      ),
      'db'           => require(dirname(__FILE__) . '/database.php'),
//      'errorHandler' => array(
//        // use 'site/error' action to display errors
//        'errorAction' => YII_DEBUG ? null : 'site/error',
//      ),
      'log'          => array(
        'class'  => 'CLogRouter',
        'routes' => array(
          array(
            'class'      => 'CFileLogRoute',
            'levels'     => 'error, warning',
            'categories' => 'system.*',
          ),
          array(
            'class'              => 'application.components.LogDb',
            'autoCreateLogTable' => true,
            'connectionID'       => 'db',
            'enabled'            => true,
            'levels'             => 'trace,info,error,warning',
          )
        ),
      ),
      'assetManager' => array(
        'class'    => 'CAssetManager',
        'basepath' => realpath(__DIR__ . '/../../assets'),
        'baseUrl'  => '/assets',
      ),
//      'request'      => array(
//        'class'                => 'application.components.SHttpRequest',
//        'csrfTokenName'        => 'token',
//        'enableCsrfValidation' => true,
//      ),
      'SmtpMail'     => array(
        'class'      => 'application.extensions.smtpmail.PHPMailer',
        'Host'       => 'smtp.gmail.com',
        'Username'   => 'beta.eproc@gmail.com',
        'Password'   => 'd0c0t3lmks',
        'Mailer'     => 'smtp',
        'Port'       => 587,
        'SMTPAuth'   => true,
        'SMTPSecure' => 'tls',
      ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'     => array(
      // this is used in contact page
      'adminEmail'     => 'webmaster@example.com',
      'cacheDuration'  => 60 * 60 * 24 * 30,
      'sessionTimeout' => 60 * 60 * 24 * 30,
      'itemPerPage'    => 10,
      'gcm_api_key'    => "AIzaSyBtNrvs1AVrYrQfYWGKV99HiUJXgCEe36o",
    ),
  );

  $modules_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR;
  $handle = opendir($modules_dir);
  while (false !== ($file = readdir($handle))) {
    if ($file != "." && $file != ".." && is_dir($modules_dir . $file)) {
      $config = CMap::mergeArray($config, require($modules_dir . $file . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php'));
    }
  }
  closedir($handle);

  return $config;
