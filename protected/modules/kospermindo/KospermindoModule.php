<?php

  class KospermindoModule extends CWebModule
  {
    /**
     * @property string the path to the layout file to use for displaying Rights.
     */
    //public $layout = 'kospermindo.views.layouts.main';
    /**
     * @property string the path to the application layout file.
     */
    //public $appLayout = 'application.views.layouts.main';
    public $returnUrl = '/kospermindo';
    public $debug = true;
    public $baseUrl = '/kospermindo';
    public $dateFormat = 'Y-m-d H:i:s';
    public $userModel;
    public $user;
    public $notifyType = 'user';
    // Messaging System can be MSG_NONE, MSG_PLAIN or MSG_DIALOG
//    public $messageSystem = Messages::MSG_DIALOG;
    private $_assetsUrl;

    /**
     * @property string the style sheet file to use for Rights.
     */
    public function init()
    {
      // this method is called when the module is being created
      // you may place code here to customize the module or the application
      //$this->baseUrl = Yii::app()->getBaseUrl(true);
      // import the module-level models and components
      $this->defaultController = 'dashboard';

      Yii::setPathOfAlias('kospermindo', dirname(__FILE__));
      $this->setImport(array(
        'kospermindo.models.*',
        'kospermindo.components.*',
        'auditTrail.models.AuditTrail',
        'application.models.*',
      ));

      if (!$this->userModel) {
        throw new Exception(Kospermindo::t('core', "Property Messaging::{userModel} not defined",
          array('{userModel}' => $this->userModel)));
      }
      if (!class_exists($this->userModel)) {
        throw new Exception(Kospermindo::t('core', "Class {userModel} not defined",
          array('{userModel}' => $this->userModel)));
      }
      Yii::app()->setComponents(
        array(
          'errorHandler' => array(
            // use 'site/error' action to display errors
            'class'       => 'CErrorHandler',
            // 'errorAction'=>$this->getId().'/kospermindo/error',
            //'errorAction' => YII_DEBUG ? null : '/kospermindo/error',
            //'errorAction'=>$this->getId().'/error',
            'errorAction' => YII_DEBUG ? null : $this->getId() . '/error',
          ),
          'user'         => array(
            'class'           => 'SWebUser',
            'allowAutoLogin'  => true,
            'loginUrl'        => Yii::app()->createUrl($this->getId() . '/login'),
            'authTimeout'     => 2592000,
            'autoRenewCookie' => true,
            //'absoluteAuthTimeout' => 2592000,
            //'autoUpdateFlash' => true,
            //'stateKeyPrefix' => '_admin',
          ),
        ), false);
      Yii::app()->user->setStateKeyPrefix('_admin');
      $this->user = Yii::app()->user;
      parent::init();
    }

    public function beforeControllerAction($controller, $action)
    {
      if (parent::beforeControllerAction($controller, $action)) {
        // this method is called before any module controller action is performed
        // you may place customized code here
        $route = $controller->id . '/' . $action->id;
//        if(!$this->allowIp(Yii::app()->request->userHostAddress) && $route!=='default/error')
//          throw new CHttpException(403,"You are not allowed to access this page.");

        $publicPages = array(
          'login',
          'error',
        );
//        if(Yii::app()->user->isGuest && !in_array($route,$publicPages))
//          Yii::app()->user->loginRequired();
//        else
        if (Yii::app()->user->isGuest) {
          Yii::app()->user->setReturnUrl('kospermindo/login');
        }

        return true;
      } else {
        return false;
      }
    }

    /**
     * Publishes the module assets path.
     * @return string the base URL that contains all published asset files of Rights.
     */
    public function getAssetsUrl()
    {
      if ($this->_assetsUrl === null) {
        $assetsPath = Yii::getPathOfAlias('kospermindo.assets');

        // We need to republish the assets if debug mode is enabled.
        if ($this->debug === true) {
          $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
        } else {
          $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
        }
      }

      return $this->_assetsUrl;
    }

    /**
     * @param string $value the base URL that contains all published asset files of gii.
     */
    public function setAssetsUrl($value)
    {
      $this->_assetsUrl = $value;
    }

    /**
     * Autocomplete function for 'To' field in view/compose. Search for usernames etc that match the string.
     *
     * @param string $term
     * #return array output json array of usernames and labels.
     */
    public function autoComplete($term)
    {
      $criteria = new CDbCriteria;

      $criteria->compare($this->usernameColumn, $term, true, 'OR');
      $criteria->compare($this->userIdColumn, $term, true, 'OR');
      //$criteria->compare('email', $term, true, 'OR');
      $criteria->mergeWith(array('limit'=>25));
      $users = call_user_func(array($this->userClass, 'model'))
        ->findAll($criteria);
      //$users = User::model()->keyword($term)->limit(100)->findAll();
      $json = '[';
      foreach($users as $user)
      {
        if($user->{$this->userIdColumn}==$this->newsUserId)
          continue;

        $json .= '{"label":"'.$user->{$this->usernameColumn}.'",'
          .'"value":"'.$user->{$this->usernameColumn}.'"},';
      }
      $json = rtrim($json,',') . ']';
      die($json);
    }


    /**
     * Opens a group for yourself and a set of other users (the group could've been previously made),
     * and returns the id of that group or false if an error has occured
     *
     * @param integer $ids
     */
    public function openGroup($ids)
    {
      if (in_array($this->user->id, $ids))//You can not open a chat with yourself!
      {
        throw new Exception(Kospermindo::t('core', "You can't open a group with yourself.", array()));
      }
      if (empty($ids) || !$ids) {
        return null;
      }
      $group = $this->groupExists($ids);

      if (!$group) {
        //Only one lock will be needed, because after writing one member from the group with a group id, no other new group can use this group-id because findLastGroup will then show another Id.
        $firstGroup = new Group();
        $transaction = $firstGroup->dbConnection->beginTransaction();
        //Helper::dd($transaction);
        Yii::app()->db->createCommand('LOCK TABLES `group` WRITE')->execute();
        try {
          $firstGroup->grup = $this->findLastGroup() + 1;
          $firstGroup->user = $this->user->id;
          $firstGroup->save();
          $transaction->commit();
        } catch (Exception $e) {
          $transaction->rollback();
          Yii::app()->db->createCommand("UNLOCK TABLES")->execute();

          return false;
        }
        Yii::app()->db->createCommand("UNLOCK TABLES")->execute();

        foreach ($ids as $id) {
          $this->addToGroup($firstGroup->grup, $id);
        }

        return $firstGroup->grup;
      } else {
        return $group;
      }
    }

    /**
     * Check if a group with exactly those members (and myself) exists in the given usergroups from a user (result from openedGroups())
     * Returns the id of the common group or false if nothing was found
     *
     * @param type $ids
     *
     * @return integer
     */
    public function groupExists($ids)
    {
      array_multisort($ids);
      $usergroups = $this->openedGroups();
      if (!$usergroups || !$ids) {
        return false;
      }
      foreach ($usergroups as $groupid => $group) {
        array_multisort($group);
        if ($ids === $group) {
          return $groupid;
        }
      }

      return false;
    }

    /**
     * Returns an array of groups with index the group id, and as value another array that contains all of those group members (excluding yourself)
     * @return array $usergroups
     */
    public function openedGroups()
    {
      //Helper::dd($this->user);
      $sql = 'SELECT t2.user, t2.grup FROM `group` t 
              JOIN `group` t2 ON t.grup = t2.grup WHERE t.user = '.$this->user->id.' AND t2.user <> '.$this->user->id;
//      $criteria = new CDbCriteria;
//      $criteria->select = 't2.user, t2.grup';
//      $criteria->condition = 't.user = :user AND t2.user <> :user';
//      $criteria->params = array(':user' => $this->user->id);
//      $criteria->join = 'JOIN ' . Group::model()->tableName() . ' t2 ON t.grup = t2.grup';
      $groups = Group::model()->findAllBySql($sql);
      $usergroups = array();
      foreach ($groups as $group) {
        $usergroups[$group->grup][] = $group->user;
      }

      return $usergroups;
    }

    /**
     * Finds the last used group
     * @return type
     */
    private function findLastGroup()
    {
      return Yii::app()->db->createCommand("SELECT MAX(`grup`) AS `max` FROM `" . Group::model()->tableName() . "` WHERE 1")->queryScalar();
    }

    /**
     * Adds a user to a group
     *
     * @param type $group group id
     * @param type $id user id
     */
    private function addToGroup($group, $id)
    {
      $newGroup = new Group();
      $newGroup->grup = $group;
      $newGroup->user = $id;
      $newGroup->save();
    }

    /**
     * Returns true if the user has unread messages
     */
    public function isUnread()
    {
      $updated = MessagesUpdated::model()->findByPk($this->user->id);

      return $updated !== null ? $updated->updated : false;
    }

    /**
     * Returns true if the user has unread messages in a certain group
     */
    public function isUnreadGroup($group)
    {
      $criteria = new CDbCriteria;
      $criteria->condition = "grp=:group AND user=:user";
      $criteria->params = array(":group" => $group, ":user" => $this->user->id);
      $updated = MessagesUpdatedGroup::model()->find($criteria);

      return $updated !== null ? $updated->updated : false;
    }

    /**
     * Sends a message to a group and notifies all those users
     *
     * @param $group group id of users
     * @param $content message to be sent
     * @param $sender message sent by
     * @param $receiver message sent to
     * @param $kodeJenis message kode jenis gudang
     * @param $kodeGudang message kode gudang
     * @param $kodeKelompok message kode Kelompok
     * @param $from message From name
     * @param $to message to name
     * @param $sentStatus message status
     * @param $reply message is reply
     * @param $read message is read
     * @param $deleted message is deleted by
     * @param $draft message save to draft
     */
    public function sendMessage($sender, $receiver,$kodeJenis,$kodeGudang,$kodeKelompok,$from,$to,$sentStatus,$reply,$read,$deleted,$draft ,$group, $content)
    {
      if (!$this->hasGroup($group)) {
        throw new Exception(Kospermindo::t('core', "User is not present in this group.", array()));
      }
      $message = new Messages();
      $message->sender_id = $sender;
      $message->receiver_id = $receiver;
      $message->kode_jenis_gudang = $kodeJenis;
      $message->kode_gudang = $kodeGudang;
      $message->kode_kelompok = $kodeKelompok;
      $message->from = $from;
      $message->to = $to;
      $message->sent_status = $sentStatus;
      $message->is_reply = $reply;
      $message->is_read = $read;
      $message->is_draft = $draft;
      $message->deleted_by = $deleted;
      $message->grup_id = $group;
      $message->content = $content;
      $message->save();
      //SET UNREAD ON GROUP MEMBERS (EXCEPT FOR SENDER)
      $criteria = new CDbCriteria;
      $criteria->condition = 'grup = :group and user <> :user';
      $criteria->params = array(':group' => $group, ':user' => $this->user->id);
      $groupUsers = Group::model()->findAll($criteria);
      foreach ($groupUsers as $user) {
        $this->setUnread($user->user);
        $this->setUnreadGroup($user->user, $group);
      }
    }

    /**
     * Check if this user is in this group
     */
    public function hasGroup($grp)
    {
      $criteria = new CDbCriteria;
      $criteria->condition = "user = :user AND grup = :grup";
      $criteria->params = array(":user" => $this->user->id, ":grup" => $grp);
      $group = Group::model()->find($criteria);

      return $group !== null;
    }

    /**
     * Sets the updated field for a user
     *
     * @param $user
     * @param $unread (default: sets to unread)
     */
    public function setUnread($user, $unread = true)
    {
      $updated = MessagesUpdated::model()->findByPk($user);
      if (!$updated) {
        $updated = new MessagesUpdated();
        $updated->userid = $user;
      }
      $updated->updated = $unread ? 1 : 0;
      $updated->save();
    }

    /**
     * Sets the updated field for a user in a group
     *
     * @param $user
     * @param $group
     * @param $unread (default: sets to unread)
     */
    public function setUnreadGroup($user, $group, $unread = true)
    {
      $criteria = new CDbCriteria;
      $criteria->condition = "grupid=:group AND userid=:user";
      $criteria->params = array(":group" => $group, ":user" => $user);
      $updated = MessagesUpdatedGroup::model()->find($criteria);
      if (!$updated) {
        $updated = new MessagesUpdatedGroup();
        $updated->userid= $user;
        $updated->grupid = $group;
      }
      $updated->updated = $unread ? 1 : 0;
      $updated->save();
    }

    /**
     * Gets your messages by group
     *
     * @param $group
     */
    public function getMessages($group)
    {
      if (!$this->hasGroup($group)) {
        throw new Exception(Kospermindo::t('core', "User is not present in this group.", array()));
      }
      $criteria = new CDbCriteria;
      $criteria->condition = 'grup_id = :group';
      $criteria->params = array(':group' => $group);
      $criteria->order = 'date_send DESC';

      return Messages::model()->findAll($criteria);
    }

    /**
     * Updates unread status of a group
     *
     * @param $group
     */
    public function readGroup($group)
    {
      $this->setUnreadGroup($this->user->id, $group, false);
      if (count($this->getUnreadGroups()) === 0) {
        $this->setUnread($this->user->id, false);
      }
    }

    /**
     * Returns all group id's (array) that contain unread messages.
     */
    public function getUnreadGroups()
    {
      $criteria = new CDbCriteria;
      $criteria->condition = 'userid=:user';
      $criteria->params = array(':user' => $this->user->id);
      $groups = MessagesUpdatedGroup::model()->findAll($criteria);
      $ids = array();
      foreach ($groups as $group) {
        $ids[] = $group->grupid;
      }

      return $ids;
    }

  }
