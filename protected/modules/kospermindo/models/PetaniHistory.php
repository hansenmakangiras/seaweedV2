<?php

/**
 * This is the model class for table "petani_history".
 *
 * The followings are the available columns in table 'petani_history':
 * @property integer $id
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
 * @property string $created_date
 * @property integer $created_by
 */
class PetaniHistory extends CActiveRecord
{
/*  public function behaviors()
  {
    return array(
      'LoggableBehavior' => 'application.modules.auditTrail.behaviors.LoggableBehavior',
    );
  }*/
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'petani_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('id_petani, id_perusahaan, status_login, status_hapus, created_by', 'numerical', 'integerOnly'=>true),
			array('nama_petani, tempat_lahir', 'length', 'max'=>100),
			array('nik', 'length', 'max'=>20),
			array('username', 'length', 'max'=>50),
			array('no_telp', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_petani, kode_petani, kode_jenis_gudang, kode_gudang, kode_kelompok, id_perusahaan, nama_petani, nik, alamat, provinsi, kabupaten, no_telp, tempat_lahir, tgl_lahir, luas_lahan, jumlah_bentangan, jenis_komoditi, url_foto, username, password, device_id, status_login, status_hapus, created_date, created_by', 'safe', 'on'=>'search'),
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
			'id_petani' => 'Id Petani',
			'kode_petani' => 'Kode Petani',
			'kode_jenis_gudang' => 'Kode Jenis Gudang',
			'kode_gudang' => 'Kode Gudang',
			'kode_kelompok' => 'Kode Kelompok',
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
		$criteria->compare('id_petani',$this->id_petani);
		$criteria->compare('kode_petani',$this->kode_petani);
		$criteria->compare('kode_jenis_gudang',$this->kode_jenis_gudang);
		$criteria->compare('kode_gudang',$this->kode_gudang);
		$criteria->compare('kode_kelompok',$this->kode_kelompok);
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
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PetaniHistory the static model class
	 */


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
