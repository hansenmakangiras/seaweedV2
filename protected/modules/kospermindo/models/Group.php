<?php

  /**
   * This is the model class for table "group".
   *
   * The followings are the available columns in table 'group':
   * @property integer $id
   * @property integer $grup
   * @property integer $user
   */
  class Group extends CActiveRecord
  {
    /**
     * Returns the static model of the specified AR class.
     * @return $className Group the static model class
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
      return 'group';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id' => Kospermindo::t('form', 'ID: '),
        'group' => Kospermindo::t('form', 'Group: '),
        'user' => Kospermindo::t('form', 'User: '),
      );
    }
  }