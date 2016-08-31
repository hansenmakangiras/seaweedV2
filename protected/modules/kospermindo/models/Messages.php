<?php

  /**
   * This is the model class for table "messages".
   *
   * The followings are the available columns in table 'messages':
   * @property integer $id
   * @property integer $grup_id
   * @property string  $kode_gudang
   * @property string  $kode_kelompok
   * @property integer $sender_id
   * @property integer $is_reply
   * @property string  $to
   * @property string  $from
   * @property integer $receiver_id
   * @property string  $content
   * @property string  $date_send
   * @property string  $date_receive
   * @property string  $deleted_by
   * @property integer $sent_status
   * @property integer $is_read
   * @property integer $is_draft
   */
  class Messages extends CActiveRecord
  {
    const STATUS_NOT_SENT = false;
    const STATUS_SENT = true;

    const STATUS_READ = true;
    const STATUS_UNREAD = false;

    const DELETED_BY_RECEIVER = 'user';
    const DELETED_BY_SENDER = 'admin';

    const MSG_NONE = 'None';
    const MSG_PLAIN = 'Plain';
    const MSG_DIALOG = 'Dialog';

    public $userModel;
    public $userModelRelation;

    public $unreadMessagesCount;


    // set $omit_mail to true to avoid e-mail notification of the
    // received message. It is mainly user for the privacy settings
    // (receive profile comment email/friendship request email/...)
    //public $omit_mail = pg_fetch_all_columns(result)e;

    public function __construct($scenario = 'insert') {
      $this->userModel = Users::model();
      $this->userModelRelation = null;
      parent::__construct($scenario);
    }

//    public function beforeValidate() {
//      if(parent::beforeValidate()) {
//        $this->timestamp = time();
//
//        $to_user = Petani::model()->findByPk($this->to);
//        if($to_user && isset($to_user->privacy)) {
//          if(in_array($this->from_user->username, $to_user->privacy->getIgnoredUsers()))
//            $this->addError('to', Kospermindo::t('One of the recipients ({username}) has ignored you. Message will not be sent!', array('{username}' => $to_user->username)));
//        }
//        return true;
//      }
//      return false;
//    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return $className Messages the static model class
     */
    public static function model($className = __CLASS__)
    {
      return parent::model($className);
    }

    public static function writeMessages($to, $from, $body)
    {
      $message = new Messages();

      if (is_object($from)) {
        $message->sender_id = (int)$from->id;
      } else {
        if (is_numeric($from)) {
          $message->sender_id = $from;
        } else {
          if (is_string($from) && $user = Users::model()->find("username = '{$from}'")) {
            $message->sender_id = $user->id;
            $message->from = $user->username;
          } else {
            return false;
          }
        }
      }

      if (is_object($to)) {
        $message->receiver_id = (int)$to->id;
      } else {
        if (is_numeric($to)) {
          $message->receiver_id = $to;
        } else {
          if (is_string($to) && $user = Petani::model()->find("username = '{$to}'")) {
            $message->receiver_id = $user->id_petani;
            $message->to = $user->username;
          } else {
            return false;
          }
        }
      }

      $message->content = $body;
      $message->is_draft = 0;
      $message->sent_status = 0;
      $message->is_read = 0;
      $message->is_reply = 0;

      return $message->save();
    }

    public function behaviors()
    {
      return array(
        'LoggableBehavior' => 'application.modules.auditTrail.behaviors.LoggableBehavior',
      );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
      return 'messages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
      // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      return array(
        array('to, from, content, date_send, date_receive', 'required'),
        array('sent_status,is_reply ,is_draft,is_read,sender_id,receiver_id,grup_id', 'numerical', 'integerOnly' => true),
        array('is_reply', 'length', 'max' => 150),
        array('to', 'length', 'max' => 150),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array(
          'id,receiver_id,grup_id, sender_id,kode_gudang,kode_kelompok, is_reply, to, from, content, date_send, date_receive, sent_status, is_read ,is_draft,deleted_by',
          'safe',
          'on' => 'search',
        ),
      );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
      // NOTE: you may need to adjust the relation name and the related
      // class name for the relations automatically generated below.
      return array(
        'from_user' => array(self::BELONGS_TO, 'Users', 'sender_id'),
        'to_user'   => array(self::BELONGS_TO, 'Petani', 'receiver_id'),
      );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id'            => 'ID',
        'sender_id'        => 'ID Pengirim',
        'receiver_id'        => 'ID Penerima',
        'grup_id'        => 'ID Grup',
        'kode_gudang'   => 'Gudang',
        'kode_kelompok' => 'Kelompok',
        'is_reply'      => 'Balasan',
        'to'            => 'Kepada',
        'from'          => 'Dari',
        'content'       => 'Pesan',
        'date_send'     => 'Tanggal Kirim',
        'date_receive'  => 'Tanggal Terima',
        'deleted_by'   => 'Dihapus Oleh',
        'sent_status'   => 'Status Kirim',
        'is_read'       => 'Telah Dibaca',
        'is_draft'      => 'Telah Disimpan pada draft',
      );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
      // @todo Please modify the following code to remove attributes that should not be searched.

      $criteria = new CDbCriteria;

      $criteria->compare('id', $this->id);
      $criteria->compare('receiver_id', $this->receiver_id);
      $criteria->compare('sender_id', $this->sender_id);
      $criteria->compare('grup_id', $this->grup_id);
      $criteria->compare('kode_gudang', $this->kode_gudang);
      $criteria->compare('kode_kelompok', $this->kode_kelompok);
      $criteria->compare('is_reply', $this->is_reply, true);
      $criteria->compare('to', $this->to, true);
      $criteria->compare('receiver_id', $this->receiver_id);
      $criteria->compare('from', $this->from, true);
      $criteria->compare('content', $this->content, true);
      $criteria->compare('date_send', $this->date_send, true);
      $criteria->compare('date_receive', $this->date_receive, true);
      $criteria->compare('sent_status', $this->sent_status);
      $criteria->compare('is_read', $this->is_read);
      $criteria->compare('is_draft', $this->is_draft);

      return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
      ));
    }

    public function scopes()
    {
      $id = Yii::app()->user->id;

      return array(
        'all'      => array(
          'condition' => "receiver_id = {$id} or sender_id = {$id}",
        ),
        'read'     => array(
          'condition' => "receiver_id = {$id} and is_read = 1",
        ),
        'sent'     => array(
          'condition' => "sender_id = {$id}",
        ),
        'answered' => array(
          'condition' => "receiver_id = {$id} and sent_status > 0",
        ),
        'byDate'   => array('order' => 'date_send DESC'),
        'byRoom'   => array(
          'condition' => 'roomid = 1',
        ),
      );
    }

    public function getStatus()
    {
      if ($this->sender_id === Yii::app()->user->id) {
        return Kospermindo::t('message', 'sent');
      };
      if($this->is_reply){
        return Kospermindo::t('message', 'reply');
      }
      if ($this->is_read) {
        return Kospermindo::t('message', 'read');
      } else {
        return Kospermindo::t('message', 'new');
      }
    }

    public function unread($id = false)
    {
      if (!$id) {
        $id = Yii::app()->user->id;
      }

      $this->getDbCriteria()->mergeWith(array(
        'condition' => "receiver_id = {$id} and is_read = 0",
      ));

      return $this;
    }

    public function checkMessageRoom($roomid)
    {
      if (isset($roomid) && is_numeric($roomid)) {
        return true;
        //$this->roomid = $roomid;
      } else {
        return false;
//      $this->roomid = $roomid + 1;
      }
    }

    public function getSenderName() {
      if ($this->sender_id) {
        return call_user_func(array($this->sender_id, Yii::app()->getNameMethod));
      }
    }

    public function getReceiverName() {
      if ($this->receiver_id) {
        return call_user_func(array($this->receiver_id, Yii::app()->getNameMethod));
      }
    }

    public static function getAdapterForInbox($userId) {
      $c = new CDbCriteria();
      $c->addCondition('t.receiver_id = :receiverId');
      $c->addCondition('t.deleted_by <> :deleted_by_receiver OR t.deleted_by IS NULL');
      $c->addCondition('t.sent_status = :status');
      $c->order = 't.date_send DESC';
      $c->params = array(
        'receiverId' => (int) $userId,
        'deleted_by_receiver' => Messages::DELETED_BY_RECEIVER,
        'status' => 0,
      );

      return new CActiveDataProvider('Messages', array('criteria' => $c));
    }

    public static function getAdapterForSent($userId) {
      $c = new CDbCriteria();
      $c->addCondition('t.sender_id = :senderId');
      $c->addCondition('t.deleted_by <> :deleted_by_sender OR t.deleted_by IS NULL');
      $c->order = 't.date_send DESC';
      $c->params = array(
        'senderId' => $userId,
        'deleted_by_sender' => Messages::DELETED_BY_SENDER,
      );
      return new CActiveDataProvider('Messages', array('criteria' => $c));
    }

    public function deleteByUser($userId) {

      if (!$userId) {
        return false;
      }

      if ($this->sender_id == $this->receiver_id && $this->receiver_id == $userId) {
        $this->delete();
        return true;
      }

      if ($this->sender_id == $userId) {
        if ($this->deleted_by == self::DELETED_BY_RECEIVER) {
          $this->delete();
        } else {
          $this->deleted_by = self::DELETED_BY_SENDER;
          $this->save();
        }

        return true;
      }

      if ($this->receiver_id == $userId) {
        if ($this->deleted_by == self::DELETED_BY_SENDER) {
          $this->delete();
        } else {
          $this->deleted_by = self::DELETED_BY_RECEIVER;
          $this->save();
        }

        return true;
      }

      // message was not deleted
      return false;
    }

    public function markAsRead() {
      if (!$this->is_read) {
        $this->is_read = true;
        $this->save();
      }
    }

    public function getCountUnreaded($userId) {
      if (!$this->unreadMessagesCount) {
        $c = new CDbCriteria();
        $c->addCondition('t.receiver_id = :receiverId');
        $c->addCondition('t.deleted_by <> :deleted_by_receiver OR t.deleted_by IS NULL');
        $c->addCondition('t.is_read = "0"');
        $c->params = array(
          'receiverId' => $userId,
          'deleted_by_receiver' => Messages::DELETED_BY_RECEIVER,
        );
        $count = self::model()->count($c);
        $this->unreadMessagesCount = $count;
      }

      return $this->unreadMessagesCount;
    }
  }
