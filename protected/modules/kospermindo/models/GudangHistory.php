<?php

  /**
   * This is the model class for table "gudang_history".
   *
   * The followings are the available columns in table 'gudang_history':
   * @property integer $id
   * @property string $nama
   * @property string $alamat
   * @property integer $kabupaten
   * @property integer $provinsi
   * @property string $latitude
   * @property string $longitude
   * @property integer $luas
   * @property string $telp
   * @property string $koordinator
   * @property integer $status
   * @property integer $id_gudang
   * @property string $created_date
   * @property string $created_by
   */
  class GudangHistory extends CActiveRecord
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
      return 'gudang_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
      // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      return array(
        //array('nama, alamat, kabupaten, provinsi, latitude, longitude, luas, telp, koordinator, status, id_gudang, created_date, created_by', 'required'),
        array('kabupaten, provinsi, luas, status, id_gudang', 'numerical', 'integerOnly'=>true),
        array('nama', 'length', 'max'=>75),
        array('latitude, longitude, telp', 'length', 'max'=>25),
        array('koordinator', 'length', 'max'=>200),
        array('created_by', 'length', 'max'=>255),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array('id, nama, alamat, kabupaten, provinsi, latitude, longitude, luas, telp, koordinator, status, id_gudang, created_date, created_by', 'safe', 'on'=>'search'),
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
        'alamat' => 'Alamat',
        'kabupaten' => 'Kabupaten',
        'provinsi' => 'Provinsi',
        'latitude' => 'Latitude',
        'longitude' => 'Longitude',
        'luas' => 'Luas',
        'telp' => 'Telp',
        'koordinator' => 'Koordinator',
        'status' => 'Status',
        'id_gudang' => 'Id Gudang',
        'created_date' => 'Created Date',
        'created_by' => 'Created By',
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
      $criteria->compare('alamat',$this->alamat,true);
      $criteria->compare('kabupaten',$this->kabupaten);
      $criteria->compare('provinsi',$this->provinsi);
      $criteria->compare('latitude',$this->latitude,true);
      $criteria->compare('longitude',$this->longitude,true);
      $criteria->compare('luas',$this->luas);
      $criteria->compare('telp',$this->telp,true);
      $criteria->compare('koordinator',$this->koordinator,true);
      $criteria->compare('status',$this->status);
      $criteria->compare('id_gudang',$this->id_gudang);
      $criteria->compare('created_date',$this->created_date,true);
      $criteria->compare('created_by',$this->created_by,true);

      return new CActiveDataProvider($this, array(
        'criteria'=>$criteria,
      ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return GudangHistory the static model class
     */
    public static function model($className=__CLASS__)
    {
      return parent::model($className);
    }
  }
