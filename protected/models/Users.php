<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property integer $id_perusahaan
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $no_handphone
 * @property integer $su_akses
 * @property string $mod_akses
 * @property integer $status
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('id_perusahaan, su_akses, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>100),
			array('email', 'length', 'max'=>255),
			array('no_handphone', 'length', 'max'=>15),
			array('password', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_perusahaan, username, password, email, no_handphone, su_akses, mod_akses, status', 'safe', 'on'=>'search'),
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
			'id_perusahaan' => 'Id Perusahaan',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'no_handphone' => 'No Handphone',
			'su_akses' => 'Su Akses',
			'mod_akses' => 'Mod Akses',
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
		$criteria->compare('id_perusahaan',$this->id_perusahaan);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('no_handphone',$this->no_handphone,true);
		$criteria->compare('su_akses',$this->su_akses);
		$criteria->compare('mod_akses',$this->mod_akses,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 10
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/* set created_date and hash the password before save is triggered */
	public function beforeSave()
	{
		if ($this->isNewRecord) {

			//$this->created_date = date('Y-m-d H:i:s');
			$this->password = $this->hashPassword($this->password);

		}

		return parent::beforeSave();
	}

	/**
	 * Checks if the given password is correct.
	 * @param string $password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		if (CPasswordHelper::verifyPassword($password, $this->password)) {
			return true;
		}

		return false;
	}

	/**
	 * Generates the password hash.
	 * @param string $password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

	public function getMenu($id){
		$menu = Menu::model()->findByAttributes(array('id'=>$id));

		return $menu->menu;
	}

	public function getModeratorMenu($id){
		$moderator = Users::model()->findByAttributes(array('id'=>$id,'su_akses'=>2,'status'=>0));

		return $moderator->mod_akses;
	}

	public function getCompanyId($id){
		$moderator = Users::model()->findByAttributes(array('id'=>$id,'su_akses'=>2,'status'=>0));
		return $moderator->id_perusahaan;
	}

	public function getUsername($id){
    $user = $this->findByPk($id);
    return isset($user) ? $user->username : '';
  }

}
