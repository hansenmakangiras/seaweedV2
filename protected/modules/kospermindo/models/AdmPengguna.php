<?php

/**
 * This is the model class for table "adm_pengguna".
 *
 * The followings are the available columns in table 'adm_pengguna':
 * @property integer $id
 * @property integer $userid
 * @property integer $warehouseid
 * @property integer $groupid
 * @property integer $levelid
 * @property integer $profileid
 * @property integer $companyid
 * @property integer $seaweed_id
 * @property string $username
 * @property string $password
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property string $deviceId
 * @property integer $status
 */
class AdmPengguna extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adm_pengguna';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, warehouseid, groupid, levelid, profileid, companyid, seaweed_id, username, password', 'required'),
			array('userid, warehouseid, groupid, levelid, profileid, companyid, seaweed_id, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>100),
			array('password, created_by, updated_by, deviceId', 'length', 'max'=>150),
			array('created_date, updated_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userid, warehouseid, groupid, levelid, profileid, companyid, seaweed_id, username, password, created_date, created_by, updated_date, updated_by, deviceId, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'userid' => 'Userid',
			'warehouseid' => 'Warehouseid',
			'groupid' => 'Groupid',
			'levelid' => 'Levelid',
			'profileid' => 'Profileid',
			'companyid' => 'Companyid',
			'seaweed_id' => 'Seaweed',
			'username' => 'Username',
			'password' => 'Password',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'deviceId' => 'Device',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('warehouseid',$this->warehouseid);
		$criteria->compare('groupid',$this->groupid);
		$criteria->compare('levelid',$this->levelid);
		$criteria->compare('profileid',$this->profileid);
		$criteria->compare('companyid',$this->companyid);
		$criteria->compare('seaweed_id',$this->seaweed_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('deviceId',$this->deviceId,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdmPengguna the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
  protected function beforeSave()
  {
    if ($this->isNewRecord) {
      $this->created_date = date('Y-m-d H:i:s');
      $this->created_by = Yii::app()->user->getName();
      $this->password = CPasswordHelper::hashPassword($this->password);
    } else {
      $this->updated_date = date('Y-m-d H:i:s');
      $this->updated_by = Yii::app()->user->getName();
    }

    return parent::beforeSave();
  }

  public function getIdUser(){
    return $this->userid;
  }

  public function getUserId($id){
    $userid = self::model()->findByPk((int) $id);
    return isset($id) ? $userid->id : null;
  }
}
