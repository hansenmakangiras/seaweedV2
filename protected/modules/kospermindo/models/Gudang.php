<?php

/**
 * This is the model class for table "gudang".
 *
 * The followings are the available columns in table 'gudang':
 * @property integer $id_gudang
 * @property string $nama
 * @property string $alamat
 * @property string $kode_gudang
 * @property string $tipe_gudang
 * @property integer $kode_jenis_gudang
 * @property integer $kabupaten
 * @property integer $provinsi
 * @property string $latitude
 * @property string $longitude
 * @property integer $luas
 * @property string $telp
 * @property string $koordinator
 * @property integer $status
 */
class Gudang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gudang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('nama, alamat, kabupaten, provinsi, latitude, longitude, luas, telp, koordinator', 'required'),
			array('kabupaten, provinsi, luas, status', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>75),
			array('latitude, longitude, telp', 'length', 'max'=>25),
			array('koordinator', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_gudang, tipe_gudang ,kode_gudang, kode_jenis_gudang, nama, alamat, kabupaten, provinsi, latitude, longitude, luas, telp, koordinator, status', 'safe', 'on'=>'search'),
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
      'all_kelompok' => array(self::BELONGS_TO, 'Kelompok', 'id_kelompok'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_gudang' => 'Id Gudang',
			'kode_gudang' => 'Kode Gudang',
			'kode_jenis_gudang' => 'Kode Jenis Gudang',
			'tipe_gudang' => 'Tipe Gudang',
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

		$criteria->compare('id_gudang',$this->id_gudang);
		$criteria->compare('kode_gudang',$this->kode_gudang);
		$criteria->compare('kode_jenis_gudang',$this->kode_jenis_gudang);
		$criteria->compare('tipe_gudang',$this->tipe_gudang);
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gudang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


  /* set created_date and hash the password before save is triggered */
  // public function beforeSave()
  // {
  //   if ($this->isNewRecord) {

  //     $this->created_date = date('Y-m-d H:i:s');
  //     $this->created_by = Yii::app()->user->getName();

  //   }else{
  //     $this->updated_date = date('Y-m-d H:i:s');
  //     $this->updated_by = Yii::app()->user->getName();
  //   }

  //   return parent::beforeSave();
  // }

	public function getProvinsi($id){
		$query = Provinsi::model()->findByAttributes(array('provinsi_id'=>$id));
		return $query->provinsi_nama;
	}

	public function getKabupaten($id){
		$query = Kotakab::model()->findByAttributes(array('kota_id'=>$id));
		return $query->kokab_nama;
	}
	public function countPetani(){
    	$query = Yii::app()->db->createCommand('SELECT COUNT(nama_petani) as total_petani FROM petani where status_hapus=0')->queryAll();
    	return $query;
    }
	public function sumProduksi(){
      $query = Yii::app()->db->createCommand('SELECT SUM(seaweed.total_panen)/1000 as total_produksi FROM seaweed JOIN jenis_komoditi ON seaweed.id_seaweed = jenis_komoditi.id_komoditi where seaweed.status=0')->queryAll();
      return $query;
    }
    public function sumProduksiByPetani($id){
      $query = Yii::app()->db->createCommand('SELECT SUM(seaweed.total_panen)/1000 as total_produksi FROM seaweed JOIN jenis_komoditi ON seaweed.id_seaweed = jenis_komoditi.id_komoditi where seaweed.status=0 AND seaweed.id_user='.$id.' ')->queryAll();
      return $query;
    }
    public function sumProduksiByJenis(){
      $query = Yii::app()->db->createCommand('SELECT seaweed.id_seaweed, SUM(seaweed.total_panen)/1000 as total_produksi , jenis_komoditi.jenis,seaweed.created_date FROM seaweed JOIN jenis_komoditi ON seaweed.id_seaweed = jenis_komoditi.id_komoditi where seaweed.status = 0 GROUP BY seaweed.id_seaweed')
      ->queryAll();
      return $query;
    }
    public function sumProduksiByJenisPetani($id){
	    $sql = "SELECT seaweed.id_seaweed, SUM(seaweed.total_panen)/1000 as total_produksi , jenis_komoditi.jenis,seaweed.created_date FROM seaweed JOIN jenis_komoditi ON seaweed.id_seaweed = jenis_komoditi.id_komoditi WHERE seaweed.id_user='".$id."' AND seaweed.status = 0 GROUP BY seaweed.id_seaweed";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
    }
    public function sumProduksiByJenisDate($date){

      $query = Yii::app()->db->createCommand()
        ->select('a.id_komoditi, b.jenis, sum(a.total_panen) as total_produksi , a.date')
        ->from('hasil_produksi a')
        ->join('jenis_komoditi b','a.id_komoditi = b.id_komoditi')
        ->where(array('LIKE', 'a.date', '%' . $date . '%'))
        ->group('a.id_komoditi')
        ->queryAll();
      
      return $query;
    }

    public function sumProduksiByJenisDateNew(){
      $query = Yii::app()->db->createCommand('SELECT id_komoditi, sum(total_panen) as total_produksi from hasil_produksi WHERE date like "%2016%" GROUP BY id_komoditi')
      ->queryAll();
      return $query; 
    }

    public function getGudang(){
      $model = $this->findAll();
      return CHtml::listData($model, 'kode_gudang', 'nama', 'tipe_gudang');
    }
    private function getJenisGudang($kodeJenis){
      $group = JenisGudang::model()->findByAttributes(array('kode_jenis_gudang' => $kodeJenis));
      return $group;
    }

}
