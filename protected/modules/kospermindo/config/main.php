<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 7/8/2016
   * Time: 3:34 PM
   */

  $module_name = basename(dirname(dirname(__FILE__)));
  $default_controller = 'default';

  return array(
    'import' => array(
      'application.modules.' . $module_name . '.models.*',
      'application.modules.' . $module_name . '.components.*',
    ),
    'modules' => array(
      $module_name => array(
        'defaultController' => $default_controller,
      ),
      'auditTrail'  => array(
        'userClass' => 'Pengguna', // the class name for the user object
        'userIdColumn' => 'id', // the column name of the primary key for the user
        'userNameColumn' => 'username', // the column name of the primary key for the user),
      ),
    ),
    'components' => array(
//      'user'         => array(
//        'class'          => 'SWebUser',
//        // enable cookie-based authentication
//        'allowAutoLogin'      => true,
//        'loginUrl'            => '/kospermindo/login',
//        'authTimeout'         => 2592000,
//        'absoluteAuthTimeout' => 2592000,
//      ),
      'clientScript' => array(
        'scriptMap' => array(
          'jquery.js' => false,
          'jquery.min.js'=>false,  //desable any others default implementation
          'core.css'=>false, //disable
          'styles.css'=>false,  //disable
          'pager.css'=>false,   //disable
          'default.css'=>false,  //disable
          )
      ),
//      'cache'        => array('class' => 'system.caching.CDummyCache'),
//      'session'      => array(
//        'sessionName' => 'SeaweedSession',
//        'class'       => 'CHttpSession',
//        //'autoStart'   => true,
//      ),
      'urlManager' => array(
        'rules' => array(
          $module_name . '/<action:\w+>/<id:\d+>' => $module_name . '/' . $default_controller . '/<action>',
          $module_name . '/<action:\w+>' => $module_name . '/' . $default_controller . '/<action>',
        ),
      ),
    ),
  );