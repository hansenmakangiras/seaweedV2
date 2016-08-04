<?php

/**
 * This is the model class for table "warehouse".
 *
 * The followings are the available columns in table 'warehouse':
 * @property integer $id
 * @property string $nama
 * @property string $lokasi
 * @property integer $penanggungjawab
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property string $deskripsi
 * @property integer $status
 */
class Warehouse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'warehouse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, lokasi, penanggungjawab', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('nama, lokasi', 'length', 'max'=>255),
			array('created_by, updated_by', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, lokasi, penanggungjawab, created_date, created_by, updated_date, updated_by, deskripsi, status', 'safe', 'on'=>'search'),
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
			'nama' => 'Nama',
			'lokasi' => 'Lokasi',
			'penanggungjawab' => 'Penanggung Jawab Gudang',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'deskripsi' => 'Deskripsi',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('lokasi',$this->lokasi,true);
		$criteria->compare('penanggungjawab',$this->penanggungjawab);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Warehouse the static model class
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

    } else {

      $this->updated_date = date('Y-m-d H:i:s');
      $this->updated_by = Yii::app()->user->getName();

    }

    return parent::beforeSave();
  }

  public function getWarehouseById($id){
    $warehouse = self::findByPk($id);
    return isset($id) ? $warehouse : null ;
  }

  public function getListWarehouse(){
    return CHtml::listData(self::model()->findAll(),'id','nama');
  }
}
