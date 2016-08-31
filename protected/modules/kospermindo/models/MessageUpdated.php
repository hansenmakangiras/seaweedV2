<?php

  /**
   * This is the model class for table "test_messages_updated_user".
   *
   * The followings are the available columns in table 'test_messages_updated_user':
   * @property integer $userid
   * @property integer $updated
   */
  class MessagesUpdated extends CActiveRecord
  {
    /**
     * Returns the static model of the specified AR class.
     * @return $className MessageUpdated the static model class
     */
    public static function model($className=__CLASS__)
    {
      return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
      return 'messages_updated_user';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'userid' => Yii::t('form', 'User: '),
        'updated' => Yii::t('form', 'Updated: '),
      );
    }
  }