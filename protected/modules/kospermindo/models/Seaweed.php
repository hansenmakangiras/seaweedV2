<?php

/**
 * This is the model class for table "seaweed".
 *
 * The followings are the available columns in table 'seaweed':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_gudang
 * @property integer $id_kelompok
 * @property integer $id_seaweed
 * @property double $kadar_air
 * @property double $total_panen
 * @property string $created_date
 * @property string $kode_produksi
 * @property string $created_by
 * @property integer $status
 */
class Seaweed extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */


	public function tableName()
	{
		return 'seaweed';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kadar_air, total_panen, created_by', 'required'),
			array('id_user, id_gudang, id_kelompok, id_seaweed, status', 'numerical', 'integerOnly'=>true),
			array('kadar_air, total_panen', 'numerical'),
			array('created_by', 'length', 'max'=>150),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_produksi, id_user, id_gudang, id_kelompok, id_seaweed, kadar_air, total_panen, created_date, created_by, status', 'safe', 'on'=>'search'),
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
			'kode_produksi' => 'Kode Produksi',
			'id_user' => 'Id User',
			'id_gudang' => 'Id Gudang',
			'id_kelompok' => 'Id Kelompok',
			'id_seaweed' => 'Id Seaweed',
			'kadar_air' => 'Kadar Air',
			'total_panen' => 'Total Panen',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('kode_produksi',$this->kode_produksi);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_gudang',$this->id_gudang);
		$criteria->compare('id_kelompok',$this->id_kelompok);
		$criteria->compare('id_seaweed',$this->id_seaweed);
		$criteria->compare('kadar_air',$this->kadar_air);
		$criteria->compare('total_panen',$this->total_panen);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

/*	public function afterSave(){
		$client = Elasticsearch\ClientBuilder::create()->setHosts(['localhost:9200'])->build();

		$params = [
			'index' => 'seaweed',
			'type' => 'hasil_seaweed',
			'id' => $this->id,
			'body' => ['id_petani' => $this->id_user, 
						'id_gudang' => $this->id_gudang,
						'id_kelompok' => $this->id_kelompok,
						'id_seaweed' => $this->id_seaweed,
						'total_panen'=>$this->total_panen,
						'kadar_air' => $this->kadar_air,
						'created_date' => $this->created_date,
						'created_by' => $this->created_by,
						'status' => $this->status]
		];
		
		$respons =  $client->index($params);
	}*/
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Seaweed the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
	{
		if ($this->isNewRecord) {
			$this->created_date = date('Y-m-d H:i:s');
		}
		
		return parent::beforeSave();
	}
	
	public function getSeaweed($id){
		$seaweed = JenisKomoditi::model()->findByAttributes(array('id_komoditi'=>$id,'status'=>0));

		return $seaweed['jenis'];
	}
	public function getJenisperdate($id, $start, $end){
		$sql = "SELECT SUM(total_panen) FROM seaweed WHERE id_seaweed='".$id."' AND status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00')";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getAllJenisGudang($start, $end, $id){
		$sql = "select distinct id_seaweed from seaweed where id_gudang='".$id."' AND status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by id_seaweed,DATE_FORMAT(created_date, '%c %d %Y')";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getAllJenisKelompok($start, $end, $id, $idKelompok){
		$sql = "select distinct id_seaweed from seaweed where id_gudang='".$id."' AND id_kelompok ='".$idKelompok."' AND status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by id_seaweed,DATE_FORMAT(created_date, '%c %d %Y')";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getAllJenisPetani($start, $end, $id, $idKelompok, $idPetani){
		$sql = "select distinct id_seaweed from seaweed where id_gudang='".$id."' AND id_kelompok ='".$idKelompok."' AND id_user ='".$idPetani."' AND status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by id_seaweed,DATE_FORMAT(created_date, '%c %d %Y')";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getDateGudang($start, $end, $id_gudang){
		$sql = "select distinct created_date from seaweed where id_gudang='".$id_gudang."' AND status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by DATE_FORMAT(created_date, '%c %d %Y')";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getCountGudang($start, $end, $id_gudang, $seaweed){
		$sql = "select sum(total_panen) as count from seaweed where id_gudang='".$id_gudang."' AND id_seaweed='".$seaweed."' ANd status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by id_seaweed";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getDateKelompok($start, $end, $id_gudang, $id_kelompok){
		$sql = "select distinct created_date from seaweed where id_gudang='".$id_gudang."' AND id_kelompok='".$id_kelompok."' AND status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by DATE_FORMAT(created_date, '%c %d %Y')";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getCountKelompok($start, $end, $id_gudang, $id_kelompok, $seaweed){
		$sql = "select sum(total_panen) as count from seaweed where id_gudang='".$id_gudang."' AND id_kelompok='".$id_kelompok."' AND id_seaweed='".$seaweed."' ANd status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by id_seaweed";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getDatePetani($start, $end, $id_gudang, $id_kelompok, $idPetani){
		$sql = "select distinct created_date from seaweed where id_gudang='".$id_gudang."' AND id_kelompok='".$id_kelompok."' AND id_user='".$idPetani."' AND status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by DATE_FORMAT(created_date, '%c %d %Y')";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getCountPetani($start, $end, $id_gudang, $id_kelompok, $idPetani, $seaweed){
		$sql = "select sum(total_panen) as count from seaweed where id_gudang='".$id_gudang."' AND id_kelompok='".$id_kelompok."' AND id_user='".$idPetani."' AND id_seaweed='".$seaweed."' ANd status=0 AND (created_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:00') group by id_seaweed";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getDayGudang($date,$id, $id_gudang){
		$sql = "select created_date,id_seaweed, sum(total_panen) as count from seaweed where created_date like '".$date."%' AND status=0 AND id_seaweed='".$id."' AND id_gudang='".$id_gudang."'";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getDayKelompok($date,$id,$idKelompok){
		$sql = "select created_date,id_seaweed, sum(total_panen) as count from seaweed where created_date like '".$date."%' AND status=0 AND id_seaweed='".$id."' AND id_kelompok='".$idKelompok."'";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}

	public function getDayPetani($date,$id,$idKelompok,$idPetani){
		$sql = "select created_date,id_seaweed, sum(total_panen) as count from seaweed where created_date like '".$date."%' AND status=0 AND id_seaweed='".$id."' AND id_kelompok='".$idKelompok."' AND id_user='".$idPetani."'";
		$search = Yii::app()->db->createCommand($sql)->queryAll();

		return $search;
	}
}
