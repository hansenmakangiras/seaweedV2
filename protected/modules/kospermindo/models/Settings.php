<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $site_title
 * @property string $help_desk_phone
 * @property string $site_url
 * @property string $email
 * @property integer $jumlah_bal
 * @property integer $nilai_tetap
 * @property double $biaya_proses
 * @property double $biaya_container
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 */
class Settings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_title, help_desk_phone, site_url, email, jumlah_bal, nilai_tetap, biaya_proses, biaya_container', 'required'),
			array('id, jumlah_bal, nilai_tetap', 'numerical', 'integerOnly'=>true),
			array('biaya_proses, biaya_container', 'numerical'),
			array('site_title, help_desk_phone, site_url, email', 'length', 'max'=>255),
			array('created_by, updated_by', 'length', 'max'=>150),
			array('created_date, updated_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, site_title, help_desk_phone, site_url, email, jumlah_bal, nilai_tetap, biaya_proses, biaya_container, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
			'site_title' => 'Site Title',
			'help_desk_phone' => 'Help Desk Phone',
			'site_url' => 'Site Url',
			'email' => 'Email',
			'jumlah_bal' => 'Jumlah Bal',
			'nilai_tetap' => 'Nilai Tetap',
			'biaya_proses' => 'Biaya Proses',
			'biaya_container' => 'Biaya Container',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
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
		$criteria->compare('site_title',$this->site_title,true);
		$criteria->compare('help_desk_phone',$this->help_desk_phone,true);
		$criteria->compare('site_url',$this->site_url,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('jumlah_bal',$this->jumlah_bal);
		$criteria->compare('nilai_tetap',$this->nilai_tetap);
		$criteria->compare('biaya_proses',$this->biaya_proses);
		$criteria->compare('biaya_container',$this->biaya_container);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Settings the static model class
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
