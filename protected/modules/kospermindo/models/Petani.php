<?php

  /**
   * This is the model class for table "petani".
   *
   * The followings are the available columns in table 'petani':
   * @property integer $id_petani
   * @property integer $id_gudang
   * @property integer $id_kelompok
   * @property integer $id_perusahaan
   * @property string  $nama_petani
   * @property string  $kode_petani
   * @property string  $kode_gudang
   * @property string  $kode_kelompok
   * @property string  $kode_jenis_gudang
   * @property string  $nik
   * @property string  $alamat
   * @property string  $provinsi
   * @property string  $kabupaten
   * @property string  $tempat_lahir
   * @property string  $tgl_lahir
   * @property integer $luas_lahan
   * @property integer $jumlah_bentangan
   * @property string  $jenis_komoditi
   * @property string  $url_foto
   * @property string  $username
   * @property string  $password
   * @property string  $device_id
   * @property integer $status_login
   * @property integer $status_hapus
   */
  class Petani extends CActiveRecord
  {
    public $oldPassword;
    public $newPassword;

//    public function behaviors()
//		{
//			return array(
//				'LoggableBehavior' => 'application.modules.auditTrail.behaviors.LoggableBehavior',
//			);
//		}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return $className Petani the static model class
     */
    public static function model($className = __CLASS__)
    {
      return parent::model($className);
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
        array('newPassword', 'required', 'on' => 'changePassword'),
        array(
          'id_perusahaan, luas_lahan, jumlah_bentangan, status_login, status_hapus',
          'numerical',
          'integerOnly' => true,
        ),
        array('nama_petani, tempat_lahir', 'length', 'max' => 100),
        array('nik', 'length', 'max' => 20),
        array('username', 'length', 'max' => 50),
        array('no_telp', 'length', 'max' => 25),
        array('oldPassword, newPassword', 'safe'),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array(
          'id_petani, kode_petani, kode_jenis_gudang, kode_gudang, kode_kelompok, id_perusahaan, nama_petani, nik, alamat, provinsi, kabupaten, no_telp, tempat_lahir, tgl_lahir, luas_lahan, jumlah_bentangan, jenis_komoditi, url_foto, username, password, device_id, status_login, status_hapus',
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
      return array(
        'from_kelompok' => array(self::BELONGS_TO, 'Kelompok', 'kode_kelompok'),
        'from_gudang'   => array(self::BELONGS_TO, 'Gudang', 'kode_gudang'),
      );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id_petani'         => 'Id Petani',
        'kode_petani'       => 'Kode Petani',
        'kode_jenis_gudang' => 'Kode Jenis Gudang',
        'kode_gudang'       => 'Kode Gudang',
        'kode_kelompok'     => 'Kode Kelompok',
        'id_perusahaan'     => 'Id Perusahaan',
        'nama_petani'       => 'Nama Petani',
        'nik'               => 'Nik',
        'alamat'            => 'Alamat',
        'provinsi'          => 'Provinsi',
        'kabupaten'         => 'Kabupaten',
        'no_telp'           => 'No Telpon',
        'tempat_lahir'      => 'Tempat Lahir',
        'tgl_lahir'         => 'Tgl Lahir',
        'luas_lahan'        => 'Luas Lahan',
        'jumlah_bentangan'  => 'Jumlah Bentangan',
        'jenis_komoditi'    => 'Jenis Komoditi',
        'url_foto'          => 'Url Foto',
        'username'          => 'Username',
        'password'          => 'Password',
        'device_id'         => 'Device',
        'status_login'      => 'Status Login',
        'status_hapus'      => 'Status Hapus',
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

      $criteria->compare('id_petani', $this->id_petani);
      $criteria->compare('kode_petani', $this->kode_petani);
      $criteria->compare('kode_jenis_gudang', $this->kode_jenis_gudang);
      $criteria->compare('kode_gudang', $this->kode_gudang);
      $criteria->compare('kode_kelompok', $this->kode_kelompok);
      $criteria->compare('id_perusahaan', $this->id_perusahaan);
      $criteria->compare('nama_petani', $this->nama_petani, true);
      $criteria->compare('nik', $this->nik, true);
      $criteria->compare('alamat', $this->alamat, true);
      $criteria->compare('provinsi', $this->provinsi, true);
      $criteria->compare('kabupaten', $this->kabupaten, true);
      $criteria->compare('no_telp', $this->no_telp, true);
      $criteria->compare('tempat_lahir', $this->tempat_lahir, true);
      $criteria->compare('tgl_lahir', $this->tgl_lahir, true);
      $criteria->compare('luas_lahan', $this->luas_lahan);
      $criteria->compare('jumlah_bentangan', $this->jumlah_bentangan);
      $criteria->compare('jenis_komoditi', $this->jenis_komoditi, true);
      $criteria->compare('url_foto', $this->url_foto, true);
      $criteria->compare('username', $this->username, true);
      $criteria->compare('password', $this->password, true);
      $criteria->compare('device_id', $this->device_id, true);
      $criteria->compare('status_login', $this->status_login);
      $criteria->compare('status_hapus', $this->status_hapus);

      return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
      ));
    }

    public function scopes()
    {
      return array(
        'lastRecord' => array(
          'order' => 'id_petani DESC',
          'limit' => 1,
        ),
      );
    }

    public function beforeSave()
    {
      if ($this->isNewRecord) {
        $this->password = CPasswordHelper::hashPassword($this->password);
      }

      return parent::beforeSave();
    }

    //matching the old password with your existing password.
//    public function findPasswords($attribute, $params)
//    {
//      $user = Petani::model()->findByPk(Yii::app()->user->id);
//      if ($user->password != md5($this->old_password))
//        $this->addError($attribute, 'Old password is incorrect.');
//    }

    public function validatePassword($password)
    {
      if (CPasswordHelper::verifyPassword($password, $this->password)) {
        return true;
      }

      return false;
    }

    public function getGudang($id)
    {
      $gudang = Gudang::model()->findByAttributes(array('kode_gudang' => $id, 'status' => 0));

      return $gudang->nama;
    }

    public function getKelompok($id)
    {
      $kelompok = Kelompok::model()->findByAttributes(array('kode_kelompok' => $id, 'status' => 0));

      return $kelompok->nama_kelompok;
    }

    public function getKomoditi($id)
    {
      $getKomo = JenisKomoditi::model()->findByAttributes(array('id_komoditi' => $id, 'status' => 0));

      return $getKomo->jenis;
    }

    public function getKabupaten($id)
    {
      $getKab = Kotakab::model()->findByAttributes(array('kota_id' => $id));

      return $getKab->kokab_nama;
    }

    public function getProvinsi($id)
    {
      $getProv = Provinsi::model()->findByAttributes(array('provinsi_id' => $id));

      return $getProv->provinsi_nama;
    }

    public function getJabatanKelompok($id)
    {
      $kelompok = Kelompok::model()->findByAttributes(array('ketua_kelompok' => $id, 'status' => 0));
      if ($kelompok) {
        $pesan = 'Ketua Kelompok';
      } else {
        $pesan = 'Petani Rumput Laut';
      }

      return $pesan;
    }

    public function countPetani()
    {
      $query = Yii::app()->db->createCommand('SELECT COUNT(nama_petani) AS total_petani FROM petani')->queryAll();

      return $query;
    }

    public function sumProduksi()
    {
      $query = Yii::app()->db->createCommand('SELECT SUM(total_panen) AS total_panen FROM hasil_produksi')->queryAll();

      return $query;
    }

    public function sumProduksiByJenis()
    {
      $query = Yii::app()->db->createCommand('SELECT hasil_produksi.id_komoditi, SUM(hasil_produksi.total_panen) AS total_produksi , jenis_komoditi.jenis,hasil_produksi.date FROM hasil_produksi JOIN jenis_komoditi ON hasil_produksi.id_komoditi = jenis_komoditi.id_komoditi GROUP BY hasil_produksi.id_komoditi')
        ->queryAll();

      return $query;
    }

    public function sumProduksiByJenisDate($date)
    {

      $query = Yii::app()->db->createCommand()
        ->select('a.id_komoditi, b.jenis, sum(a.total_panen) as total_produksi , a.date')
        ->from('hasil_produksi a')
        ->join('jenis_komoditi b', 'a.id_komoditi = b.id_komoditi')
        ->where(array('LIKE', 'a.date', '%' . $date . '%'))
        ->group('a.id_komoditi')
        ->queryAll();

      return $query;
    }

    public function sumProduksiByJenisDateNew()
    {
      $query = Yii::app()->db->createCommand('SELECT id_komoditi, sum(total_panen) AS total_produksi FROM hasil_produksi WHERE date LIKE "%2016%" GROUP BY id_komoditi')
        ->queryAll();

      return $query;
    }

    public function getnamapetani()
    {
      $models = $this->findAll(
        array(
          'condition' => 'status_hapus = :status',
          'params'    => array(':status' => 0),
        ));

      return CHtml::listData($models, 'id_petani', 'nama_petani');
    }

    public function getDisplayName($id)
    {
      $models = $this->findByPk((int)$id);

      return !empty($models) ? $models->nama_petani : null;
    }

    public function getUserName($id)
    {
      $id = isset($id) ? (int)$id : 0;
      if ($id) {
        $user = $this->findByPk($id);
      }

      return isset($user) ? $user->username : null;
    }
  }
