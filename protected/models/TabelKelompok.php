<?php

/**
 * This is the model class for table "tabel_kelompok".
 *
 * The followings are the available columns in table 'tabel_kelompok':
 * @property integer $id
 * @property string $nama_kelompok
 * @property string $ketua_kelompok
 * @property string $id_user
 * @property integer $id_perusahaan
 * @property integer $status
 */
class TabelKelompok extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tabel_kelompok';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('ketua_kelompok', 'required'),
			array('id_perusahaan, status', 'numerical', 'integerOnly'=>true),
			array('nama_kelompok', 'length', 'max'=>255),
			array('ketua_kelompok, id_user', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_kelompok, ketua_kelompok, id_user, id_perusahaan, status', 'safe', 'on'=>'search'),
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
			'nama_kelompok' => 'Nama Kelompok',
			'ketua_kelompok' => 'Ketua Kelompok',
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
		$criteria->compare('nama_kelompok',$this->nama_kelompok,true);
		$criteria->compare('ketua_kelompok',$this->ketua_kelompok,true);
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
	 * @return TabelKelompok the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function changeStatusPetani($idkelompok,$status){
	  	$query = Yii::app()->db->createCommand()
	  	->update('tabel_petani', array(
		    'status'=>$status,
		), 
		'id_user=:id', array(':id'=>$idkelompok));
	  }
  public function getKoordinator(){
    return CHtml::listData(TabelKoordinator::model()->findAll(),'id_koordinator','id_koordinator');
  }
}
