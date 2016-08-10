<?php

/**
 * This is the model class for table "jenis_komoditi".
 *
 * The followings are the available columns in table 'jenis_komoditi':
 * @property integer $id_komoditi
 * @property integer $parent_id
 * @property string $jenis
 * @property integer $status
 */
class JenisKomoditi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jenis_komoditi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, jenis, status', 'required'),
			array('parent_id, status', 'numerical', 'integerOnly'=>true),
			array('jenis', 'length', 'max'=>75),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_komoditi, parent_id, jenis, status', 'safe', 'on'=>'search'),
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
			'id_komoditi' => 'Id Komoditi',
			'parent_id' => 'Parent',
			'jenis' => 'Jenis',
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

		$criteria->compare('id_komoditi',$this->id_komoditi);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('jenis',$this->jenis,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function scopes(){
		return array(
			'lastRecord' => array(
				'order'=>'id_komoditi DESC',
				'limit'=>1
			)
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JenisKomoditi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
