<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 7/8/2016
   * Time: 3:34 PM
   */

  $module_name = basename(dirname(dirname(__FILE__)));
  $default_controller = 'dashboard';

  return array(
    'import' => array(
      'application.modules.' . $module_name . '.models.*'
    ),

    'modules' => array(
      $module_name => array(
        'defaultController' => $default_controller,
        'modules' => array(
          'rights' => array(
            'superuserName'      => 'SuperAdmin',
            'userClass'          => 'Users',
            'authenticatedName'  => 'Authenticated',
            'userIdColumn'       => 'id',
            'userNameColumn'     => 'username',
            'baseUrl'            => '/superadmin/rights',
            'layout'             => 'rights.views.layouts.main',
            'appLayout'          => 'application.modules.superadmin.views.layouts.main',
            'displayDescription' => false,
            'install'            => false,
            'debug'              => true,
          ),
        )
      ),
    ),

    'components' => array(
//      'user'         => array(
//        //'class'          => 'superadmin.modules.rights.components.RWebUser',
//        'class'          => 'SAdminWebUser',
//        // enable cookie-based authentication
//        'allowAutoLogin'      => true,
//        'loginUrl'            => '/superadmin/login',
//        'authTimeout'         => 2592000,
//        //'absoluteAuthTimeout' => 2592000,
//        'stateKeyPrefix' => '_superadmin',
//      ),
      'urlManager' => array(
        'rules' => array(
          $module_name . '/<action:\w+>/<id:\d+>' => $module_name . '/' . $default_controller . '/<action>',
          $module_name . '/<action:\w+>' => $module_name . '/' . $default_controller . '/<action>',
        ),
      ),
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
      'authManager'  => array(
        'class'           => 'RDbAuthManager',
        'defaultRoles'    => array('Authenticated', 'Guest'),
        'connectionID'    => 'db',
        'itemTable'       => 'authitem',
        'assignmentTable' => 'authassignment',
        'itemChildTable'  => 'authitemchild',
        'rightsTable'     => 'rights',
      ),
    ),
  );