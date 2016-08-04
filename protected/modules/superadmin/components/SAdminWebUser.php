<?php
  /**
   * Panrita web user class file.
   *
   * @author Hansen Makangiras <hansen@docotel.co.id>
   * @copyright Copyright &copy; 2016 Hansen Makangiras
   * @since 0.1
   */
  class SAdminWebUser extends CWebUser
  {
    /**
     * Actions to be taken after logging in.
     * Overloads the parent method in order to mark superusers.
     * @param boolean $fromCookie whether the login is based on cookie.
     */
    public function afterLogin($fromCookie)
    {
      parent::afterLogin($fromCookie);

      // Mark the user as a superuser if necessary.
      if( Users::model()->isSuperUser()===true )
        $this->isSuperuser = true;

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

    /**
     * Performs access check for this user.
     * Overloads the parent method in order to allow superusers access implicitly.
     * @param string $operation the name of the operation that need access check.
     * @param array $params name-value pairs that would be passed to business rules associated
     * with the tasks and roles assigned to the user.
     * @param boolean $allowCaching whether to allow caching the result of access checki.
     * This parameter has been available since version 1.0.5. When this parameter
     * is true (default), if the access check of an operation was performed before,
     * its result will be directly returned when calling this method to check the same operation.
     * If this parameter is false, this method will always call {@link CAuthManager::checkAccess}
     * to obtain the up-to-date access result. Note that this caching is effective
     * only within the same request.
     * @return boolean whether the operations can be performed by this user.
     */
    public function checkAccess($operation, $params=array(), $allowCaching=true)
    {
      // Allow superusers access implicitly and do CWebUser::checkAccess for others.
      return $this->isSuperuser===true ? true : parent::checkAccess($operation, $params, $allowCaching);
    }

    /**
     * @param boolean $value whether the user is a superuser.
     */
    public function setIsSuperuser($value)
    {
      $this->setState('Panrita_isSuperuser', $value);
    }

    /**
     * @return boolean whether the user is a superuser.
     */
    public function getIsSuperuser()
    {
      return $this->getState('Panrita_isSuperuser');
    }

    /**
     * @param boolean $value whether the user is a superuser.
     */
    public function setIsAdmin($value)
    {
      $this->setState('Panrita_isAdmin', $value);
    }

    /**
     * @return boolean whether the user is a superuser.
     */
    public function getIsAdmin()
    {
      return $this->getState('Panrita_isAdmin');
    }

    /**
     * @param array $value return url.
     */
    public function setPanritaReturnUrl($value)
    {
      $this->setState('Panrita_returnUrl', $value);
    }

    /**
     * Returns the URL that the user should be redirected to
     * after updating an authorization item.
     * @param string $defaultUrl the default return URL in case it was not set previously. If this is null,
     * the application entry URL will be considered as the default return URL.
     * @return string the URL that the user should be redirected to
     * after updating an authorization item.
     */
    public function getPanritaReturnUrl($defaultUrl=null)
    {
      if( ($returnUrl = $this->getState('Panrita_returnUrl'))!==null )
        $this->returnUrl = null;

      return $returnUrl!==null ? CHtml::normalizeUrl($returnUrl) : CHtml::normalizeUrl($defaultUrl);
    }
  }
