<?php

// uncomment the following to define a path alias
//  Yii::setPathOfAlias('cms', 'application.modules.cms');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
  $config = array(
    'basePath'   => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'Panrita',

    // preloading 'log' component
    'preload'    => array('log'),
    'language'   => 'id',

    // autoloading model and component classes
    'import'     => array(
      'application.models.*',
      'application.components.*',
      'application.extensions.*',
      'application.modules.auditTrail.models.AuditTrail',
    ),
    'modules'    => array(
      'gii'         => array(
        'class'     => 'system.gii.GiiModule',
        'password'  => 'sembarang',
        'ipFilters' => array('127.0.0.1', '::1'),
      ),
      'auditTrail'  => array(
        'class' => 'application.modules.auditTrail.AuditTrailModule',
        'userClass'      => 'Petani', // the class name for the user object
        'userIdColumn'   => 'id_petani', // the column name of the primary key for the user
        'userNameColumn' => 'username', // the column name of the primary key for the user),
      ),
      'kospermindo' => array(
        'class' => 'application.modules.kospermindo.KospermindoModule',
        'userModel'=> 'Petani',
      ),
      'superadmin'  => array(
        'class' => 'application.modules.superadmin.SuperadminModule',
      ),
    ),
    // application components
    'components' => array(
      'apns'       => array(
        'class'       => 'ext.apns-gcm.YiiApns',
        'environment' => 'sandbox',
        'pemFile'     => dirname(__FILE__) . '/apnssert/apns-dev.pem',
        'dryRun'      => false,
        'options'     => array(
          'sendRetryTimes' => 5,
        ),
      ),
      'gcm'        => array(
        'class'  => 'ext.apns-gcm.YiiGcm',
        'apiKey' => isset(Yii::app()->params['gcm_api_key']) ? Yii::app()->params['gcm_api_key'] : 'AIzaSyBU4rG6kYA5MIlhr8L2DKtOc4oE-JJ4HaI',
      ),
      'apnsGcm'    => array(
        'class' => 'ext.apns-gcm.YiiApnsGcm',
      ),
      // uncomment the following to enable URLs in path-format
      'urlManager' => array(
        'urlFormat'      => 'path',
        'showScriptName' => false,
        'rules'          => array(
          'role'                            => 'rights',
          'users'                           => 'user',

          // REST patterns
          array('api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET'),
          array('api/view', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
          array('api/update', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
          array('api/delete', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
          array('api/create', 'pattern' => 'api/<model:\w+>', 'verb' => 'POST'),

          '<controller:\w+>/<id:\d+>'              => '<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
          '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',

          // lupa sandi 
          'kospermindo/lupasandi/gantisandi/<id:\d+>/<token:.*>' => 'kospermindo/lupasandi/gantisandi/<id:\d+>/<token:\d+>',
        ),
      ),
//      'cache'        => array('class' => 'system.caching.CDummyCache'),
//      'session'      => array(
//        'sessionName' => 'SeaweedSession',
//        'class'       => 'CHttpSession',
//        //'autoStart'   => true,
//      ),
      'db'         => require(dirname(__FILE__) . '/database.php'),
//      'errorHandler' => array(
//        // use 'site/error' action to display errors
//        'errorAction' => YII_DEBUG ? null : 'kospermindo/error',
//      ),
      'log'        => array(
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
          ),
        ),
      ),
//      'assetManager' => array(
//        'class'    => 'CAssetManager',
//        'basepath' => realpath(__DIR__ . '/../../assets'),
//        'baseUrl'  => '/assets',
//        'linkAssets' => true,
//      ),

		'SmtpMail' => array(
			'class'	=>	'application.extensions.smtpmail.PHPMailer',
			'Host'	=>	'smtp.gmail.com',
			'Username' => 'wdesasoppeng@gmail.com',
			'Password' => 'SoppengKAB',
			'Mailer' => 'smtp',
			'Port' => 587,
			'SMTPAuth' => true,
			'SMTPSecure' => 'tls',
		),

      'clientScript' => array(
        'scriptMap' => array(
          'jquery.js'             => false,
          'jquery.ba-bbq.js'      => true,
          'jquery.ba-bbq.min.js'  => true,
          'jquery.yiigridview.js' => false,
          'jquery.min.js'         => false,  //desable any others default implementation
          'core.css'              => true, //disable
          'styles.css'            => true,  //disable
          'pager.css'             => false,   //disable
          'default.css'           => false,  //disable
        ),
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
      'gcm_api_key'    => "AIzaSyBU4rG6kYA5MIlhr8L2DKtOc4oE-JJ4HaI",
    ),
  );

//  $modules_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR;
//  $handle = opendir($modules_dir);
//  while (false !== ($file = readdir($handle))) {
//    if ($file != "." && $file != ".." && is_dir($modules_dir . $file)) {
//      $config = CMap::mergeArray($config, require($modules_dir . $file . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php'));
//    }
//  }
//  closedir($handle);

  return $config;
