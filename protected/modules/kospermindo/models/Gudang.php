<?php

/**
 * This is the model class for table "gudang".
 *
 * The followings are the available columns in table 'gudang':
 * @property integer $id
 * @property string $deskripsi
 * @property string $lokasi
 * @property string $kabupaten
 * @property string $provinsi
 * @property string $titik_koordinat
 * @property double $luas_gudang
 * @property double $stok_masuk
 * @property double $stok_keluar
 * @property double $jumlah_stok
 * @property string $created_date
 * @property string $updated_date
 * @property string $created_by
 * @property string $updated_by
 * @property integer $status
 */
class Gudang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gudang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lokasi, kabupaten, provinsi, titik_koordinat, luas_gudang, stok_masuk, stok_keluar', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('luas_gudang, stok_masuk, stok_keluar, jumlah_stok', 'numerical'),
			array('deskripsi', 'length', 'max'=>100),
			array('lokasi, created_by, updated_by', 'length', 'max'=>150),
			array('kabupaten, provinsi', 'length', 'max'=>255),
			array('created_date, updated_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, deskripsi, lokasi, kabupaten, provinsi, titik_koordinat, luas_gudang, stok_masuk, stok_keluar, jumlah_stok, created_date, updated_date, created_by, updated_by, status', 'safe', 'on'=>'search'),
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
			'deskripsi' => 'Deskripsi',
			'lokasi' => 'Lokasi',
			'kabupaten' => 'Kabupaten',
			'provinsi' => 'Provinsi',
			'titik_koordinat' => 'Titik Koordinat',
			'luas_gudang' => 'Luas Gudang',
			'stok_masuk' => 'Stok Masuk',
			'stok_keluar' => 'Stok Keluar',
			'jumlah_stok' => 'Jumlah Stok',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'created_by' => 'Created By',
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
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('lokasi',$this->lokasi,true);
		$criteria->compare('kabupaten',$this->kabupaten,true);
		$criteria->compare('provinsi',$this->provinsi,true);
		$criteria->compare('titik_koordinat',$this->titik_koordinat,true);
		$criteria->compare('luas_gudang',$this->luas_gudang);
		$criteria->compare('stok_masuk',$this->stok_masuk);
		$criteria->compare('stok_keluar',$this->stok_keluar);
		$criteria->compare('jumlah_stok',$this->jumlah_stok);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('created_by',$this->created_by,true);
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
	 * @return Gudang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  /* set created_date and hash the password before save is triggered */
  public function beforeSave()
  {
    if ($this->isNewRecord) {

      $this->created_date = date('Y-m-d H:i:s');
      $this->created_by = Yii::app()->user->getName();

    }else{
      $this->updated_date = date('Y-m-d H:i:s');
      $this->updated_by = Yii::app()->user->getName();
    }

    return parent::beforeSave();
  }
}
