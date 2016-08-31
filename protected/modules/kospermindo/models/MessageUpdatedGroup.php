<?php

  /**
   * This is the model class for table "test_messages_updated_group".
   *
   * The followings are the available columns in table 'test_messages_updated_group':
   * @property integer $id
   * @property integer $userid
   * @property integer $grupid
   * @property integer $updated
   */
  class MessagesUpdatedGroup extends CActiveRecord
  {
    /**
     * Returns the static model of the specified AR class.
     * @return $className MessageUpdatedGroup the static model class
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
      return 'messages_updated_group';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id' => Yii::t('form', 'ID: '),
        'userid' => Yii::t('form', 'User: '),
        'grupid' => Yii::t('form', 'Group: '),
        'updated' => Yii::t('form', 'Updated: '),
      );
    }
  }