<?php

/**
 * This is the model class for table "profiles".
 *
 * The followings are the available columns in table 'profiles':
 * @property integer $id
 * @property integer $userid
 * @property string $nama_lengkap
 * @property string $image
 * @property string $firstname
 * @property string $lastname
 * @property string $no_telp
 * @property string $alamat
 * @property string $nmr_identitas
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $deskripsi
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Profiles extends CActiveRecord
{
//  public function behaviors()
//  {
//    return array(
//      'LoggableBehavior' => 'application.modules.auditTrail.behaviors.LoggableBehavior',
//    );
//  }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, nama_lengkap, firstname, lastname, no_telp, tempat_lahir, tanggal_lahir', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('nama_lengkap, image, firstname, lastname, no_telp', 'length', 'max'=>255),
			array('nmr_identitas', 'length', 'max'=>25),
			array('tempat_lahir', 'length', 'max'=>100),
			array('deskripsi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userid, nama_lengkap, image, firstname, lastname, no_telp, alamat, nmr_identitas, tempat_lahir, tanggal_lahir, deskripsi', 'safe', 'on'=>'search'),
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
			//'user' => array(self::BELONGS_TO, 'Users', 'userid'),
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
			'nama_lengkap' => 'Nama Lengkap',
			'image' => 'Image',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'no_telp' => 'No Telp',
			'alamat' => 'Alamat',
			'nmr_identitas' => 'Nmr Identitas',
			'tempat_lahir' => 'Tempat Lahir',
			'tanggal_lahir' => 'Tanggal Lahir',
			'deskripsi' => 'Deskripsi',
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
		$criteria->compare('nama_lengkap',$this->nama_lengkap,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('nmr_identitas',$this->nmr_identitas,true);
		$criteria->compare('tempat_lahir',$this->tempat_lahir,true);
		$criteria->compare('tanggal_lahir',$this->tanggal_lahir,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Profiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
