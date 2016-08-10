<?php

  /**
   * This is the model class for table "petani".
   *
   * The followings are the available columns in table 'petani':
   * @property integer $id_petani
   * @property integer $id_gudang
   * @property integer $id_kelompok
   * @property integer $id_perusahaan
   * @property string $nama_petani
   * @property string $nik
   * @property string $alamat
   * @property string $provinsi
   * @property string $kabupaten
   * @property string $tempat_lahir
   * @property string $tgl_lahir
   * @property integer $luas_lahan
   * @property integer $jumlah_bentangan
   * @property string $jenis_komoditi
   * @property string $url_foto
   * @property string $username
   * @property string $password
   * @property string $device_id
   * @property integer $status_login
   * @property integer $status_hapus
   */
  class Petani extends CActiveRecord
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
      return 'petani';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
      // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      return array(
        array('id_kelompok, id_perusahaan, nama_petani, nik, alamat, provinsi, kabupaten, no_telp, tempat_lahir, tgl_lahir, luas_lahan, jumlah_bentangan, jenis_komoditi, url_foto, username, password, status_login, status_hapus', 'required'),
        array('id_gudang, id_kelompok, id_perusahaan, luas_lahan, jumlah_bentangan, status_login, status_hapus', 'numerical', 'integerOnly'=>true),
        array('nama_petani, provinsi, kabupaten, tempat_lahir', 'length', 'max'=>100),
        array('nik, jenis_komoditi', 'length', 'max'=>20),
        array('jenis_komoditi', 'length', 'max'=>50),
        array('username', 'length', 'max'=>50),
        array('no_telp', 'length', 'max'=>25),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array('id_petani, id_gudang, id_kelompok, id_perusahaan, nama_petani, nik, alamat, provinsi, kabupaten, no_telp, tempat_lahir, tgl_lahir, luas_lahan, jumlah_bentangan, jenis_komoditi, url_foto, username, password, device_id, status_login, status_hapus', 'safe', 'on'=>'search'),
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
        'id_petani' => 'Id Petani',
        'id_gudang' => 'Id Gudang',
        'id_kelompok' => 'Id Kelompok',
        'id_perusahaan' => 'Id Perusahaan',
        'nama_petani' => 'Nama Petani',
        'nik' => 'Nik',
        'alamat' => 'Alamat',
        'provinsi' => 'Provinsi',
        'kabupaten' => 'Kabupaten',
        'no_telp' => 'No Telpon',
        'tempat_lahir' => 'Tempat Lahir',
        'tgl_lahir' => 'Tgl Lahir',
        'luas_lahan' => 'Luas Lahan',
        'jumlah_bentangan' => 'Jumlah Bentangan',
        'jenis_komoditi' => 'Jenis Komoditi',
        'url_foto' => 'Url Foto',
        'username' => 'Username',
        'password' => 'Password',
        'device_id' => 'Device',
        'status_login' => 'Status Login',
        'status_hapus' => 'Status Hapus',
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

      $criteria->compare('id_petani',$this->id_petani);
      $criteria->compare('id_gudang',$this->id_gudang);
      $criteria->compare('id_kelompok',$this->id_kelompok);
      $criteria->compare('id_perusahaan',$this->id_perusahaan);
      $criteria->compare('nama_petani',$this->nama_petani,true);
      $criteria->compare('nik',$this->nik,true);
      $criteria->compare('alamat',$this->alamat,true);
      $criteria->compare('provinsi',$this->provinsi,true);
      $criteria->compare('kabupaten',$this->kabupaten,true);
      $criteria->compare('no_telp',$this->no_telp,true);
      $criteria->compare('tempat_lahir',$this->tempat_lahir,true);
      $criteria->compare('tgl_lahir',$this->tgl_lahir,true);
      $criteria->compare('luas_lahan',$this->luas_lahan);
      $criteria->compare('jumlah_bentangan',$this->jumlah_bentangan);
      $criteria->compare('jenis_komoditi',$this->jenis_komoditi,true);
      $criteria->compare('url_foto',$this->url_foto,true);
      $criteria->compare('username',$this->username,true);
      $criteria->compare('password',$this->password,true);
      $criteria->compare('device_id',$this->device_id,true);
      $criteria->compare('status_login',$this->status_login);
      $criteria->compare('status_hapus',$this->status_hapus);

      return new CActiveDataProvider($this, array(
        'criteria'=>$criteria,
      ));
    }

    public function scopes(){
      return array(
        'lastRecord' => array(
          'order'=>'id_petani DESC',
          'limit'=>1
        )
      );
    }

    function beforeSave(){
      if($this->isNewRecord){
        $this->password = CPasswordHelper::hashPassword($this->password);
      }
      return parent::beforeSave();
    }

    public function validatePassword($password)
    {
      if (CPasswordHelper::verifyPassword($password, $this->password)) {
        return true;
      }

      return false;
    }

    public function getGudang($id){
      $gudang = Gudang::model()->findByAttributes(array('id_gudang'=>$id, 'status'=>1));

      return $gudang['nama'];
    }
    public function getKelompok($id){
      $kelompok = Kelompok::model()->findByAttributes(array('id_kelompok'=>$id, 'status'=>1));

      return $kelompok['nama_kelompok'];
    }

    public function getKomoditi($allid){
      $arrid = explode(",", $allid);
      $arrKomoditi = array();

      for ($i=0; $i < count($arrid)-1; $i++) {
        $getKomo = JenisKomoditi::model()->findByAttributes(array('id_komoditi'=>$arrid[$i], 'status'=>1));
        $arr = $getKomo['jenis'];
        array_push($arrKomoditi, $arr);
      }

      return $arrKomoditi;
    }
    public function getJabatanKelompok($id){
      $kelompok = Kelompok::model()->findByAttributes(array('ketua_kelompok'=>$id, 'status'=>1));
      if($kelompok){
        $pesan = 'Ketua Kelompok';
      }else{
        $pesan = 'Petani Rumput Laut';
      }

      return $pesan;
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Petani the static model class
     */
    public static function model($className=__CLASS__)
    {
      return parent::model($className);
    }
  }
