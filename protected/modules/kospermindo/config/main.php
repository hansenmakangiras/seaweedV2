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
      'urlManager' => array(
        'rules' => array(
          $module_name . '/<action:\w+>/<id:\d+>' => $module_name . '/' . $default_controller . '/<action>',
          $module_name . '/<action:\w+>' => $module_name . '/' . $default_controller . '/<action>',
        ),
      ),
    ),
  );