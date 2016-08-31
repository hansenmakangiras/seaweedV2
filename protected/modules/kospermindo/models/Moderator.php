<?php

/**
 * This is the model class for table "moderator".
 *
 * The followings are the available columns in table 'moderator':
 * @property integer $id_moderator
 * @property integer $id_petani
 * @property string $moderator_nama
 * @property integer $is_petani
 * @property integer $status
 */
class Moderator extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'moderator';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('moderator_nama', 'required'),
			array('id_petani, is_petani, status', 'numerical', 'integerOnly'=>true),
			array('moderator_nama', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_moderator, id_petani, moderator_nama, is_petani, status', 'safe', 'on'=>'search'),
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
			'id_moderator' => 'Id Moderator',
			'id_petani' => 'Id Petani',
			'moderator_nama' => 'Moderator Nama',
			'is_petani' => 'Is Petani',
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

		$criteria->compare('id_moderator',$this->id_moderator);
		$criteria->compare('id_petani',$this->id_petani);
		$criteria->compare('moderator_nama',$this->moderator_nama,true);
		$criteria->compare('is_petani',$this->is_petani);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Moderator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
