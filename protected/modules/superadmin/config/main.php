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
      'application.modules.' . $module_name . '.models.*',
      'application.modules.rights.*',
      'application.modules.rights.components.*',
      'application.modules.rights.components.dataproviders.*',
    ),

    'modules' => array(
      $module_name => array(
        'defaultController' => $default_controller,
        'modules' =>array(
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
        ),
      ),
    ),

    'components' => array(
//      'user'         => array(
//        'class'          => 'RWebUser',
//        // enable cookie-based authentication
//        'allowAutoLogin'      => true,
//        'loginUrl'            => '/superadmin/login',
//        'authTimeout'         => 2592000,
//        //'absoluteAuthTimeout' => 2592000,
//      ),
      'urlManager' => array(
        'rules' => array(
          $module_name . '/<action:\w+>/<id:\d+>' => $module_name . '/' . $default_controller . '/<action>',
          $module_name . '/<action:\w+>' => $module_name . '/' . $default_controller . '/<action>',
        ),
      ),
      'authManager'  => array(
        'class'           => 'RDbAuthManager',
        //'defaultRoles'    => array('Authenticated', 'Guest'),
        'connectionID'    => 'db',
        'itemTable'       => 'authitem',
        'assignmentTable' => 'authassignment',
        'itemChildTable'  => 'authitemchild',
        'rightsTable'     => 'rights',
      ),
    ),
  );