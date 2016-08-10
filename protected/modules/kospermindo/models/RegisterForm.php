<?php

  /**
   * LoginForm class.
   * LoginForm is the data structure for keeping
   * user login form data. It is used by the 'login' action of 'SiteController'.
   */
  class RegisterForm extends CFormModel
  {
    public $username;
    public $password;
    public $rememberMe;

    private $_identity;

    public function behaviors()
    {
      return array(
        'LoggableBehavior' => 'application.modules.auditTrail.behaviors.LoggableBehavior',
      );
    }

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
      return array(
        // username and password are required
        array('username, password', 'required'),
        // rememberMe needs to be a boolean
        array('rememberMe', 'boolean'),
      );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
      return array(
        'rememberMe'=>'Remember me next time',
      );
    }


  }
