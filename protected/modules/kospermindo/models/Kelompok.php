<?php

/**
 * This is the model class for table "kelompok".
 *
 * The followings are the available columns in table 'kelompok':
 * @property integer $id_kelompok
 * @property string $nama_kelompok
 * @property integer $ketua_kelompok
 * @property integer $id_gudang
 * @property integer $status
 */
class Kelompok extends CActiveRecord
{
  public function behaviors()
  {
    return array(
      'LoggableBehavior' => 'application.modules.auditTrail.behaviors.LoggableBehavior',
    );
  }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kelompok';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('nama_kelompok, ketua_kelompok, id_gudang, status', 'required'),
			array('ketua_kelompok, id_gudang, status', 'numerical', 'integerOnly'=>true),
			array('nama_kelompok', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_kelompok, nama_kelompok, ketua_kelompok, id_gudang, status', 'safe', 'on'=>'search'),
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
			'id_kelompok' => 'Id Kelompok',
			'nama_kelompok' => 'Nama Kelompok',
			'ketua_kelompok' => 'Ketua Kelompok',
			'id_gudang' => 'Id Gudang',
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

		$criteria->compare('id_kelompok',$this->id_kelompok);
		$criteria->compare('nama_kelompok',$this->nama_kelompok,true);
		$criteria->compare('ketua_kelompok',$this->ketua_kelompok);
		$criteria->compare('id_gudang',$this->id_gudang);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kelompok the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNamaGudang($id){
		$query = Gudang::model()->findByAttributes(array('id_gudang'=>$id));

		if(!empty($query)){
			return $query->nama;	
		}else{
			return "Gudang Belum ditentukan";
		}
		
	}

	public function getNamaPetani($id){
		$query = Petani::model()->findByAttributes(array('id_petani'=>$id));

		if(!empty($query)){
			return $query->nama_petani;	
		}else{
			return "Ketua Kelompok Belum ditentukan";
		}
	}

}
