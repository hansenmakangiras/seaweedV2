<?php

/**
 * This is the model class for table "tabel_koordinator".
 *
 * The followings are the available columns in table 'tabel_koordinator':
 * @property integer $id
 * @property string $nama_gudang
 * @property string $nama_koordinator
 * @property string $lokasi_gudang
 * @property string $id_user
 * @property integer $id_perusahaan
 * @property integer $status
 */
class TabelKoordinator extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tabel_koordinator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('lokasi_gudang, id_perusahaan', 'required'),
			array('id_perusahaan, status', 'numerical', 'integerOnly'=>true),
			array('nama_gudang, nama_koordinator', 'length', 'max'=>255),
			array('lokasi_gudang, id_user', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_gudang, nama_koordinator, lokasi_gudang, id_user, id_perusahaan, status', 'safe', 'on'=>'search'),
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
			'nama_gudang' => 'Nama Gudang',
			'nama_koordinator' => 'Nama Koordinator',
			'lokasi_gudang' => 'Lokasi Gudang',
			'id_user' => 'Id User',
			'id_perusahaan' => 'Id Perusahaan',
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
		$criteria->compare('nama_gudang',$this->nama_gudang,true);
		$criteria->compare('nama_koordinator',$this->nama_koordinator,true);
		$criteria->compare('lokasi_gudang',$this->lokasi_gudang,true);
		$criteria->compare('id_user',$this->id_user,true);
		$criteria->compare('id_perusahaan',$this->id_perusahaan);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TabelKoordinator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
