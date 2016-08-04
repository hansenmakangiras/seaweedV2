<?php

/**
 * This is the model class for table "user_pengguna".
 *
 * The followings are the available columns in table 'user_pengguna':
 * @property integer $id
 * @property integer $id_perusahaan
 * @property integer $levelid
 * @property string $username
 * @property string $password
 *
 * The followings are the available model relations:
 * @property Company $idPerusahaan
 * @property Level $level
 */
class UserPengguna extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_pengguna';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('id_perusahaan, levelid, username, password', 'required'),
			array('id_perusahaan, levelid', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>100),
			array('password', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_perusahaan, levelid, username, password', 'safe', 'on'=>'search'),
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
			'idPerusahaan' => array(self::BELONGS_TO, 'Company', 'id_perusahaan'),
			'level' => array(self::BELONGS_TO, 'Level', 'levelid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_perusahaan' => 'Id Perusahaan',
			'levelid' => 'Levelid',
			'username' => 'Username',
			'password' => 'Password',
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
		$criteria->compare('id_perusahaan',$this->id_perusahaan);
		$criteria->compare('levelid',$this->levelid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPengguna the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getLevel(){
		return CHtml::listData(Level::model()->findAll(),'levelid','levelid');
	}
	public function beforeSave()
  {
    if ($this->isNewRecord) {
      //$this->created_date = Date('Y-m-d H:i:s');

      // $salt = openssl_random_pseudo_bytes(22);
      // $salt = '$2a$%13$' . strtr(base64_encode($salt), array('_' => '.', '~' => '/'));

      //$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);

      //$this->password = crypt($this->password, $salt);
      $this->password = CPasswordHelper::hashPassword($this->password);
    } else {
      //$this->updated_date = Date('Y-m-d H:i:s');
    }
    return parent::beforeSave();
  }

  public function validatePassword($password)
  {
    //var_dump($this->password);
    // $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
    // return crypt($password, $this->password) == $this->password;
//      if ($password === $this->password) {
//        return true;
//      }

    if(CpasswordHelper::verifyPassword($password, $this->password)){
      return true;
    }

    return false;
  }
}
