<?php

/**
 * This is the model class for table "pusat_informasi".
 *
 * The followings are the available columns in table 'pusat_informasi':
 * @property integer $id
 * @property string $kontak
 * @property string $telp
 * @property integer $admin_kontak
 */
class PusatInformasi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pusat_informasi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('kontak, telp, admin_kontak', 'required'),
			array('admin_kontak', 'numerical', 'integerOnly'=>true),
			array('kontak', 'length', 'max'=>75),
			array('telp', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kontak, telp, admin_kontak', 'safe', 'on'=>'search'),
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
			'kontak' => 'Kontak',
			'telp' => 'Telp',
			'admin_kontak' => 'Admin Kontak',
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
		$criteria->compare('kontak',$this->kontak,true);
		$criteria->compare('telp',$this->telp,true);
		$criteria->compare('admin_kontak',$this->admin_kontak);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PusatInformasi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

	public function getKontak($id){
      $query = Yii::app()->db->createCommand('SELECT * FROM ( SELECT * FROM pusat_informasi ORDER BY id DESC LIMIT 2) sub WHERE admin_kontak='.$id.' ORDER BY id ASC')->queryAll();
      return $query;
    }
}
