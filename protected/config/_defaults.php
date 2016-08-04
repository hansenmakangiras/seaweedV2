<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 7/10/2016
   * Time: 3:35 PM
   */

return array(
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
  'name'     => 'Seaweed',
  'preload'  => array('log'),
  'import'   => array(
    'application.models.*',
    'application.components.*',
    'application.extensions.*'
  ),
  'modules'    => array(
    'gii'    => array(
      'class'     => 'system.gii.GiiModule',
      'password'  => 'sembarang',
      'ipFilters' => array('127.0.0.1', '::1'),
    ),
  ),
  // application components
  'components' => array(
    'urlManager'   => array(
      'urlFormat'      => 'path',
      'showScriptName' => false,
      'rules'          => array(
        //'dashboard' => 'dashboard/dashboard',
        '<controller:\w+>/<id:\d+>'              => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
      ),
    ),
    'moduleManager' => array(
      //'class' => 'application.components.ModuleManager',
    ),
    'messages' => array(
      //'class' => 'application.components.DocoPhpMessageSource',
    ),
    'input' => array(
      //'class' => 'application.extension.CmsInput',
      //'cleanPost' => false,
      //'cleanGet' => false,
    ),
    'interceptor' => array(
      //'class' => 'DocoInterceptor',
    ),
    'cache'        => array(
      'class' => 'system.caching.CDummyCache'
    ),
    'session'      => array(
      'sessionName' => 'SeaweedSession',
      'class'       => 'CHttpSession',
      'autoStart'   => true,
    ),
    // database settings are configured in database.php
    'db'           => require(dirname(__FILE__) . '/database.php'),
    'errorHandler' => array(
      // use 'site/error' action to display errors
      'errorAction' => YII_DEBUG ? null : 'site/error',
    ),
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
        // uncomment the following to show log messages on web pages
//          array(
//            'class'  => 'CWebLogRoute',
//            'levels' => 'trace,info,error,warning',
//            'filter' => array(
//              'class'         => 'CLogFilter',
//              'prefixSession' => true,
//              'prefixUser'    => false,
//              'logUser'       => false,
//              'logVars'       => array(),
//            ),
//          ),
      ),
    ),
    'assetManager' => array(
      'class'    => 'CAssetManager',
      'basepath' => realpath(__DIR__ . '/../../assets'),
      'baseUrl'  => '/assets',
    ),
      'request'      => array(
//        'class'                => 'application.components.SHttpRequest',
//        'csrfTokenName'        => 'token',
//        'enableCsrfValidation' => true,
      ),
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
    'adminEmail'     => 'webmaster@example.com',
    'cacheDuration'  => 60 * 60 * 24 * 30,
    'sessionTimeout' => 60 * 60 * 24 * 30,
    'itemPerPage'    => 10,
    'installed' => false,
    'availableLanguages' => array(
      'en' => 'English (US)',
      'en_gb' => 'English (UK)',
      'id' => 'Indonesian',
    ),
    'dynamicConfigFile' => dirname(__FILE__) . '/local/_settings.php',
  ),
);