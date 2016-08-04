<?php

  /**
   * This is the model class for table "tabel_petani".
   *
   * The followings are the available columns in table 'tabel_petani':
   * @property integer $id
   * @property string  $nama_petani
   * @property string  $alamat
   * @property string  $no_telp
   * @property string  $nmr_identitas
   * @property string  $tempat_lahir
   * @property string  $tanggal_lahir
   * @property integer $luas_lokasi
   * @property string  $jenis_komoditi
   * @property integer $kadar_air
   * @property integer $jumlah_bentangan
   * @property string  $id_user
   * @property integer $id_perusahaan
   * @property integer $status
   */
  class TabelPetani extends CActiveRecord
  {
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
      return 'tabel_petani';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
      // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      return array(
        // array('alamat, no_telp, nmr_identitas, tempat_lahir, tanggal_lahir, luas_lokasi, jenis_komoditi, kadar_air, jumlah_bentangan', 'required'),
        array('luas_lokasi, kadar_air, jumlah_bentangan, id_perusahaan, status', 'numerical', 'integerOnly' => true),
        array('nama_petani, alamat, tempat_lahir, id_user', 'length', 'max' => 100),
        array('no_telp', 'length', 'max' => 20),
        array('nmr_identitas', 'length', 'max' => 25),
        array('jenis_komoditi', 'length', 'max' => 255),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array(
          'id, nama_petani, alamat, no_telp, nmr_identitas, tempat_lahir, tanggal_lahir, luas_lokasi, jenis_komoditi, kadar_air, jumlah_bentangan, id_user, id_perusahaan, status',
          'safe',
          'on' => 'search',
        ),
      );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
      // NOTE: you may need to adjust the relation name and the related
      // class name for the relations automatically generated below.
      return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id'               => 'ID',
        'nama_petani'      => 'Nama Petani',
        'alamat'           => 'Alamat',
        'no_telp'          => 'No Telp',
        'nmr_identitas'    => 'Nmr Identitas',
        'tempat_lahir'     => 'Tempat Lahir',
        'tanggal_lahir'    => 'Tanggal Lahir',
        'luas_lokasi'      => 'Luas Lokasi',
        'jenis_komoditi'   => 'Jenis Komoditi',
        'kadar_air'        => 'Kadar Air',
        'jumlah_bentangan' => 'Jumlah Bentangan',
        'id_user'          => 'Id User',
        'id_perusahaan'    => 'Id Perusahaan',
        'status'           => 'Status',
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

      $criteria = new CDbCriteria;

      $criteria->compare('id', $this->id);
      $criteria->compare('nama_petani', $this->nama_petani, true);
      $criteria->compare('alamat', $this->alamat, true);
      $criteria->compare('no_telp', $this->no_telp, true);
      $criteria->compare('nmr_identitas', $this->nmr_identitas, true);
      $criteria->compare('tempat_lahir', $this->tempat_lahir, true);
      $criteria->compare('tanggal_lahir', $this->tanggal_lahir, true);
      $criteria->compare('luas_lokasi', $this->luas_lokasi);
      $criteria->compare('jenis_komoditi', $this->jenis_komoditi, true);
      $criteria->compare('kadar_air', $this->kadar_air);
      $criteria->compare('jumlah_bentangan', $this->jumlah_bentangan);
      $criteria->compare('id_user', $this->id_user, true);
      $criteria->compare('id_perusahaan', $this->id_perusahaan);
      $criteria->compare('status', $this->status);

      return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
      ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return TabelPetani the static model class
     */
    public static function model($className = __CLASS__)
    {
      return parent::model($className);
    }

    public function getListType()
    {
      return array(
        'jenis_komoditi' => 'Sango-sango Laut',
        'Euchema Cotoni',
        'Spinosom',
        array('Gracillia' => 'KW 3', 'KW 4', 'BS'),
      );

    }

    public function sumAllFarmers($jenis_komoditi)
    {
      $query = Yii::app()->db->createCommand()
        ->select('*')
        ->from('tabel_petani')
        ->where('jenis_komoditi=:jenis_komoditi', array(':jenis_komoditi' => $jenis_komoditi))
        ->queryAll();

      return count($query);
    }

    public function sumAllSeaweedType()
    {
      $models = TabelPetani::model()->findAllByAttributes(
        array(
          'condition' => 'levelid = :id AND status = :status',
          'params'    => array(':id' => 2, ':status' => 1),
        )
      );
    }
  }
