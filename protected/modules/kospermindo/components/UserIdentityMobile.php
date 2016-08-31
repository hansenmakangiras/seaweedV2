<?php

  /**
   * UserIdentity represents the data needed to identity a user.
   * It contains the authentication method that checks if the provided
   * data can identity the user.
   */
  class UserIdentityMobile extends CUserIdentity
  {
    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    private $_id;
    private $_lastLogin;

    public function authenticate()
    {
      //$users = Users::model()->findByAttributes(array('username' => $this->username));
      $users = Petani::model()->find(array(
        'condition' => 'username = :username',
        'params'    => array(':username' => $this->username),
      ));
      if ($users === null) {
        $this->errorCode = self::ERROR_USERNAME_INVALID;
      } else {
        if (!$users->validatePassword($this->password)) {
          $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
          $this->_id = $users->id_petani;
          $this->setState('isUserMobileLogin', true);
          $this->setState('username', $users->username);
          $this->setState('loggingIn', true);
          $this->setState('akses', 0);
          $this->setState('userData', serialize($users->attributes));
          $this->setState('UserMobileLoginName', $this->username);
          $this->setState('UserMobileLoginId', $this->getId());
          $this->errorCode = self::ERROR_NONE;
        }
      }

      return !$this->errorCode;
    }

    public function getId()
    {
      return $this->_id;
    }
  }
