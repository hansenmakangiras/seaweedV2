<?php

/**
 * This is the model class for table "wilayah".
 *
 * The followings are the available columns in table 'wilayah':
 * @property integer $lokasi_ID
 * @property string $lokasi_kode
 * @property string $lokasi_nama
 * @property integer $lokasi_propinsi
 * @property string $lokasi_kabupatenkota
 * @property string $lokasi_kecamatan
 * @property string $lokasi_kelurahan
 */
class Wilayah extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wilayah';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lokasi_propinsi, lokasi_kecamatan, lokasi_kelurahan', 'required'),
			array('lokasi_propinsi', 'numerical', 'integerOnly'=>true),
			array('lokasi_kode', 'length', 'max'=>50),
			array('lokasi_nama', 'length', 'max'=>100),
			array('lokasi_kabupatenkota, lokasi_kecamatan', 'length', 'max'=>2),
			array('lokasi_kelurahan', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lokasi_ID, lokasi_kode, lokasi_nama, lokasi_propinsi, lokasi_kabupatenkota, lokasi_kecamatan, lokasi_kelurahan', 'safe', 'on'=>'search'),
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
			'lokasi_ID' => 'Lokasi',
			'lokasi_kode' => 'Lokasi Kode',
			'lokasi_nama' => 'Lokasi Nama',
			'lokasi_propinsi' => 'Lokasi Propinsi',
			'lokasi_kabupatenkota' => 'Lokasi Kabupatenkota',
			'lokasi_kecamatan' => 'Lokasi Kecamatan',
			'lokasi_kelurahan' => 'Lokasi Kelurahan',
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

		$criteria->compare('lokasi_ID',$this->lokasi_ID);
		$criteria->compare('lokasi_kode',$this->lokasi_kode,true);
		$criteria->compare('lokasi_nama',$this->lokasi_nama,true);
		$criteria->compare('lokasi_propinsi',$this->lokasi_propinsi);
		$criteria->compare('lokasi_kabupatenkota',$this->lokasi_kabupatenkota,true);
		$criteria->compare('lokasi_kecamatan',$this->lokasi_kecamatan,true);
		$criteria->compare('lokasi_kelurahan',$this->lokasi_kelurahan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Wilayah the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  public function getProvinsi($kode){
//    $provinsi = array();
    $kode = isset($kode) ? (int) $kode : null;
//    if(!empty($kode)){
      $model = self::model()->findAllByAttributes(array('lokasi_propinsi' => $kode));
      $provinsi = CHtml::listData($model, 'lokasi_propinsi','lokasi_nama');
//    }
    return $provinsi;
  }

  public function getKabupaten($kodekab,$kodeprovinsi = 73){
    $provinsi = array();
    $kodekab = isset($kodekab) ? (int) $kodekab : null;
    if(isset($kodeprovinsi)){
      if(!empty($kodekab)){
        $model = self::model()->findAllByAttributes(array('lokasi_propinsi' => $kodeprovinsi,'lokasi_kabupatenkota' => (int) $kodekab));
        $kabupaten = CHtml::listData($model, 'lokasi_kabupatenkota','lokasi_nama');
      }
    }

    return $kabupaten;
  }
}
