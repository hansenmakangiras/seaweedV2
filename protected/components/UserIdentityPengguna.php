<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentityPengguna extends CUserIdentity
{
    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    private $_id;
    private $_username;

    public function authenticate()
    {
        $users = Pengguna::model()->findByAttributes(array('username' => $this->username));
        if($users === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        //else if(!$users->validatePassword($this->password))
        else if(!CPasswordHelper::verifyPassword($this->password, $users->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else{
            $this->_id = $users->id;
            $this->setState('username', $users->username);
            $this->errorCode = self::ERROR_NONE;
        }

        //return $this->errorCode === self::ERROR_NONE;
        return !$this->errorCode;
    }

    public function getId(){
        return $this->_id;
    }

    public function getUsername(){
        return $this->_username;
    }
}
