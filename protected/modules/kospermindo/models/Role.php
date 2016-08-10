<?php

/**
 * This is the model class for table "role".
 *
 * The followings are the available columns in table 'role':
 * @property integer $roleid
 * @property string $controllerid
 * @property string $actionid
 * @property integer $userid
 * @property integer $create
 * @property integer $read
 * @property integer $delete
 * @property integer $show
 */
class Role extends CActiveRecord
{
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
		return 'role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('controllerid, actionid, userid, create, read, delete, show', 'required'),
			array('userid, create, read, delete, show', 'numerical', 'integerOnly'=>true),
			array('controllerid, actionid', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('roleid, controllerid, actionid, userid, create, read, delete, show', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'roleid' => 'Roleid',
			'controllerid' => 'Controllerid',
			'actionid' => 'Actionid',
			'userid' => 'Userid',
			'create' => 'Create',
			'read' => 'Read',
			'delete' => 'Delete',
			'show' => 'Show',
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

		$criteria=new CDbCriteria;

		$criteria->compare('roleid',$this->roleid);
		$criteria->compare('controllerid',$this->controllerid,true);
		$criteria->compare('actionid',$this->actionid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('create',$this->create);
		$criteria->compare('read',$this->read);
		$criteria->compare('delete',$this->delete);
		$criteria->compare('show',$this->show);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Role the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
