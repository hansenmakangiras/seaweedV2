<?php

/**
 * This is the model class for table "petani".
 *
 * The followings are the available columns in table 'petani':
 * @property integer $id
 * @property integer $penggunaid
 * @property integer $profileid
 * @property integer $kelompokid
 * @property integer $gudangid
 * @property integer $seaweedid
 * @property string $jenis_seaweed
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property integer $status
 */
class Petani extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'petani';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('penggunaid, profileid, kelompokid, gudangid, seaweedid', 'required'),
			array('penggunaid, profileid, kelompokid, gudangid, seaweedid, status', 'numerical', 'integerOnly'=>true),
			array('jenis_seaweed, created_by', 'length', 'max'=>255),
			array('updated_by', 'length', 'max'=>150),
			array('created_date, updated_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, penggunaid, profileid, kelompokid, gudangid, seaweedid, jenis_seaweed, created_date, created_by, updated_date, updated_by, status', 'safe', 'on'=>'search'),
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
      'gudang' => array(self::BELONGS_TO, 'Gudang', 'id'),
      'kelompok' => array(self::BELONGS_TO, 'KelompokTani', 'id'),
      'seaweed' => array(self::HAS_MANY, 'Seaweed', 'id'),
      'pengguna' => array(self::HAS_MANY, 'Pengguna', 'id'),
      'profile' => array(self::BELONGS_TO, 'Profiles', 'id'),
    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'penggunaid' => 'Penggunaid',
			'profileid' => 'Profileid',
			'kelompokid' => 'Kelompokid',
			'gudangid' => 'Gudangid',
			'seaweedid' => 'Seaweedid',
			'jenis_seaweed' => 'Jenis Seaweed',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
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
		$criteria->compare('penggunaid',$this->penggunaid);
		$criteria->compare('profileid',$this->profileid);
		$criteria->compare('kelompokid',$this->kelompokid);
		$criteria->compare('gudangid',$this->gudangid);
		$criteria->compare('seaweedid',$this->seaweedid);
		$criteria->compare('jenis_seaweed',$this->jenis_seaweed,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Petani the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
