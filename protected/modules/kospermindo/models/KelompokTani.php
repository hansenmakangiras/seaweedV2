<?php

/**
 * This is the model class for table "kelompok_tani".
 *
 * The followings are the available columns in table 'kelompok_tani':
 * @property integer $id
 * @property integer $gudangid
 * @property integer $penggunaid
 * @property string $nama_kelompok
 * @property string $ketua_kelompok
 * @property string $deskripsi
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property integer $status
 */
class KelompokTani extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kelompok_tani';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gudangid, penggunaid, nama_kelompok, ketua_kelompok, deskripsi, created_date, created_by, updated_date', 'required'),
			array('gudangid, penggunaid, status', 'numerical', 'integerOnly'=>true),
			array('nama_kelompok, created_by, updated_by', 'length', 'max'=>150),
			array('ketua_kelompok', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gudangid, penggunaid, nama_kelompok, ketua_kelompok, deskripsi, created_date, created_by, updated_date, updated_by, status', 'safe', 'on'=>'search'),
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
      'gudang' => array(self::HAS_ONE, 'Gudang', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gudangid' => 'Gudangid',
			'penggunaid' => 'Penggunaid',
			'nama_kelompok' => 'Nama Kelompok',
			'ketua_kelompok' => 'Ketua Kelompok',
			'deskripsi' => 'Deskripsi',
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
		$criteria->compare('gudangid',$this->gudangid);
		$criteria->compare('penggunaid',$this->penggunaid);
		$criteria->compare('nama_kelompok',$this->nama_kelompok,true);
		$criteria->compare('ketua_kelompok',$this->ketua_kelompok,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
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
	 * @return KelompokTani the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
