<?php
  /**
   * Panrita web user class file.
   *
   * @author Hansen Makangiras <hansen@docotel.co.id>
   * @copyright Copyright &copy; 2016 Hansen Makangiras
   * @since 0.1
   */
  class SWebUser extends CWebUser
  {

    public $_data;
    public $isSuperUser = false;
    private $model = null;
    //private $_keyPrefix;

    public function init()
    {
      parent::init();
      Yii::app()->getSession()->open();
      if($this->getIsGuest() && $this->allowAutoLogin)
        $this->restoreFromCookie();
      elseif($this->autoRenewCookie && $this->allowAutoLogin)
        $this->renewCookie();
      if($this->autoUpdateFlash)
        $this->updateFlash();
      $this->updateAuthStatus();
    }

//    /**
//     * @return string a prefix for the name of the session variables storing user session data.
//     */
//    public function getStateKeyPrefix()
//    {
//      if($this->_keyPrefix!==null)
//        return $this->_keyPrefix;
//      else
//        return $this->_keyPrefix=md5('Yii.'.get_class($this).'.'.Yii::app()->getId());
//    }
//    /**
//     * @param string $value a prefix for the name of the session variables storing user session data.
//     */
//    public function setStateKeyPrefix($value)
//    {
//      $this->_keyPrefix=$value;
//    }

    public function data(){
      if($this->_data instanceof Users){
        return $this->_data;
      }else if($this->id && $this->_data = Users::model()->findByPk($this->id)){
        return $this->_data;
      }else{
        return $this->_data = new Users();
      }
    }

    public function loggedInAs() {
      if($this->isGuest)
        return Kospermindo::t('core','Guest');
      else
        return $this->data()->username;
    }

    /**
     * Return admin status.
     * @return boolean
     */
    public function isAdmin() {
      if($this->isGuest)
        return false;
      else
        return Yii::app()->user->data()->su_akses;
    }
    public function getUsername(){
      if($this->isGuest)
        return Kospermindo::t('core','Guest');
      else
        return $this->data()->username;
    }
    /**
     * Actions to be taken after logging in.
     * Overloads the parent method in order to mark superusers.
     * @param boolean $fromCookie whether the login is based on cookie.
     */
    protected function afterLogin($fromCookie)
    {
      parent::afterLogin($fromCookie);

      // Mark the user as a superuser if necessary.
      if (parent::beforeLogout()) {
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if(isset($user->last_login)){
          $user->last_login = date('Y-m-d H:i:s');
          $user->saveAttributes(array('last_login'));
        }
        return true;
      } else {
        return false;
      }
    }

    public function getModel()
    {
      if(!isset($this->id)) $this->model = new Users;
      if($this->model === null)
        $this->model = Users::model()->findByPk($this->id);
      return $this->model;
    }

    public function __get($name) {
      try {
        return parent::__get($name);
      } catch (CException $e) {
        $m = $this->getModel();
        if($m->__isset($name))
          return $m->{$name};
        else throw $e;
      }
    }

    public function __set($name, $value) {
      try {
        return parent::__set($name, $value);
      } catch (CException $e) {
        $m = $this->getModel();
        $m->{$name} = $value;
      }
    }

    public function __call($name, $parameters) {
      try {
        return parent::__call($name, $parameters);
      } catch (CException $e) {
        $m = $this->getModel();
        return call_user_func_array(array($m,$name), $parameters);
      }
    }
  }
