<?php

/**
 * This is the model class for table "komoditi".
 *
 * The followings are the available columns in table 'komoditi':
 * @property integer $id
 * @property string $id_user
 * @property string $nama_komoditi
 * @property integer $jenis_komoditi
 * @property integer $total_panen
 * @property integer $kadar_air
 * @property integer $jumlah_bentangan
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CompanyKomoditiUserLevel[] $companyKomoditiUserLevels
 */
class Komoditi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'komoditi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('total_panen', 'required'),
			array('jenis_komoditi, total_panen, kadar_air, jumlah_bentangan, status', 'numerical', 'integerOnly'=>true),
			array('id_user', 'length', 'max'=>100),
			array('nama_komoditi', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, nama_komoditi, jenis_komoditi, total_panen, kadar_air, jumlah_bentangan, status', 'safe', 'on'=>'search'),
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
			'companyKomoditiUserLevels' => array(self::HAS_MANY, 'CompanyKomoditiUserLevel', 'komoditi_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'nama_komoditi' => 'Nama Komoditi',
			'jenis_komoditi' => 'Jenis Komoditi',
			'total_panen' => 'Total Panen',
			'kadar_air' => 'Kadar Air',
			'jumlah_bentangan' => 'Jumlah Bentangan',
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
		$criteria->compare('id_user',$this->id_user,true);
		$criteria->compare('nama_komoditi',$this->nama_komoditi,true);
		$criteria->compare('jenis_komoditi',$this->jenis_komoditi);
		$criteria->compare('total_panen',$this->total_panen);
		$criteria->compare('kadar_air',$this->kadar_air);
		$criteria->compare('jumlah_bentangan',$this->jumlah_bentangan);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Komoditi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
