<?php

/**
 * This is the model class for table "komoditi_type".
 *
 * The followings are the available columns in table 'komoditi_type':
 * @property integer $id
 * @property string $type
 * @property string $prefix
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Company[] $companies
 */
class KomoditiType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'komoditi_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, description', 'length', 'max'=>255),
			array('prefix', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, prefix, description', 'safe', 'on'=>'search'),
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
			'companies' => array(self::HAS_MANY, 'Company', 'komoditi_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'prefix' => 'Prefix',
			'description' => 'Description',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KomoditiType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  public function getKomoditiTipe(){
    return CHtml::listData(KomoditiType::model()->findAll(),'id','type');
  }

  public function trKomoditiTipe($tipe){
    $tipe = (int) $tipe;
    if($tipe){
      $d = KomoditiType::model()->findByPk($tipe);
//      foreach ($d->attributes as $value){
//        $typ = $key;
//        Helper::dd($value);
//      }
      return $d->type;
    }
  }
}
