<?php

  /**
   * UserIdentity represents the data needed to identity a user.
   * It contains the authentication method that checks if the provided
   * data can identity the user.
   */
  class UserIdentity extends CUserIdentity
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
      $users = Users::model()->find(array(
        'condition' => 'username = :username AND status = 0',
        'params'    => array(':username' => $this->username),
      ));
      if (!$users) {
        $users = Petani::model()->find(array(
          'condition' => 'username = :username AND status_hapus = 0',
          'params'    => array(':username' => $this->username),
        ));
        $users_akses = 3;
        $user_id = $users->id_petani;
      } else {
        $users_akses = $users->su_akses;
        $user_id = $users->id;
      }

      if ($users === null) {
        $this->errorCode = self::ERROR_USERNAME_INVALID;
      } else {
        if (!$users->validatePassword($this->password)) {
          $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
          $this->_id = $user_id;
          //setcookie("logged_in", $users->username);
          $this->setState('username', $users->username);
          $this->setState('loggingIn', true);
          $this->setState('logged_user', "kospermindo");
          $this->setState('loggingIn', true);
          $this->setState('akses', $users_akses);
          $this->setState('userData', serialize($users->attributes));
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
