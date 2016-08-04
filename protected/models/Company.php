<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $id
 * @property string $prefix
 * @property string $name
 * @property string $type
 * @property string $location
 * @property string $telephone
 * @property string $address
 * @property integer $komoditi_type
 *
 * The followings are the available model relations:
 * @property KomoditiType $komoditiType
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prefix', 'required'),
			array('komoditi_type', 'numerical', 'integerOnly'=>true),
			array('prefix', 'length', 'max'=>50),
			array('name, type, location', 'length', 'max'=>255),
			array('telephone', 'length', 'max'=>20),
			array('address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, prefix, name, type, location, telephone, address, komoditi_type', 'safe', 'on'=>'search'),
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
			'komoditiType' => array(self::BELONGS_TO, 'KomoditiType', 'komoditi_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'prefix' => 'Prefix',
			'name' => 'Name',
			'type' => 'Type',
			'location' => 'Location',
			'telephone' => 'Telephone',
			'address' => 'Address',
			'komoditi_type' => 'Komoditi Type',
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
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('komoditi_type',$this->komoditi_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getKomoditiTipe(){
    	return CHtml::listData(KomoditiType::model()->findAll(),'type','type');
  	}

  	public function getPerusahaan($id){
  		$query = Yii::app()->db->createCommand()
		->select('*')
		->from('users')
		->where('id=:id', array(':id'=>$id))
		->queryAll();
		return $query;
  	}
}
