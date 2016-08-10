<?php


class TabelKelompok extends CActiveRecord
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
			//array('ketua_kelompok, idgudang, created_date, created_by, updated_date, updated_by', 'required'),
			array('idgudang, status', 'numerical', 'integerOnly'=>true),
			array('nama_kelompok, created_by, updated_by', 'length', 'max'=>255),
			array('ketua_kelompok', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_kelompok, ketua_kelompok, idgudang, status, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
			'idgudang' => 'Idgudang',
			'status' => 'Status',
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
		$criteria->compare('nama_kelompok',$this->nama_kelompok,true);
		$criteria->compare('ketua_kelompok',$this->ketua_kelompok,true);
		$criteria->compare('idgudang',$this->idgudang);
		$criteria->compare('status',$this->status);
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
    public function getNamaPetani($status,$idkelompok){
      $models = TabelPetani::model()->findAll(
        array(
          'condition' => 'status = :status AND idkelompok = :idkelompok',
          'params'    => array(':status' => 1, ':idkelompok' =>$idkelompok),
          )
        );
        return CHtml::listData($models, 'id', 'nama_petani');
    }
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
	public function getLokasiGudang($id){
		$query = Gudang::model()->findByAttributes(array('id'=>$id));
		return $query->lokasi;
	}
	public function kelompoklist(){
		$models = TabelPetani::model()->findAll(array('condition' => 'idkelompok = ' . $this->idkelompok, 'order'=> 'id'));

		foreach ($models as $model)
			$_items[$model->id] = $model->nama;

		return $_items;
	}
}
