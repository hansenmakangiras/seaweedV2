<?php

/**
 * This is the model class for table "tabel_petani".
 *
 * The followings are the available columns in table 'tabel_petani':
 * @property integer $id
 * @property string $nama_petani
 * @property string $alamat
 * @property string $no_telp
 * @property string $nmr_identitas
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property integer $luas_lokasi
 * @property string $jenis_komoditi
 * @property integer $kadar_air
 * @property integer $jumlah_bentangan
 * @property integer $id_user
 * @property integer $id_perusahaan
 * @property integer $idkelompok
 * @property integer $idgudang
 * @property integer $is_ketuakelompok
 * @property integer $is_moderator
 * @property integer $status
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 */
class TabelPetani extends CActiveRecord
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
			//array('alamat, no_telp, nmr_identitas, tempat_lahir, tanggal_lahir, luas_lokasi, jenis_komoditi, kadar_air, jumlah_bentangan, idkelompok, idgudang, is_ketuakelompok, is_moderator, created_date, created_by, updated_date, updated_by', 'required'),
			array('luas_lokasi, kadar_air, jumlah_bentangan, id_user, id_perusahaan, idkelompok, idgudang, is_ketuakelompok, is_moderator, status', 'numerical', 'integerOnly'=>true),
			array('nama_petani, alamat, tempat_lahir', 'length', 'max'=>100),
			array('no_telp', 'length', 'max'=>20),
			array('nmr_identitas', 'length', 'max'=>25),
			array('jenis_komoditi, created_by, updated_by', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_petani, alamat, no_telp, nmr_identitas, tempat_lahir, tanggal_lahir, luas_lokasi, jenis_komoditi, kadar_air, jumlah_bentangan, id_user, id_perusahaan, idkelompok, idgudang, is_ketuakelompok, is_moderator, status, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
			'nama_petani' => 'Nama Petani',
			'alamat' => 'Alamat',
			'no_telp' => 'No Telp',
			'nmr_identitas' => 'Nmr Identitas',
			'tempat_lahir' => 'Tempat Lahir',
			'tanggal_lahir' => 'Tanggal Lahir',
			'luas_lokasi' => 'Luas Lokasi',
			'jenis_komoditi' => 'Jenis Komoditi',
			'kadar_air' => 'Kadar Air',
			'jumlah_bentangan' => 'Jumlah Bentangan',
			'id_user' => 'Id User',
			'id_perusahaan' => 'Id Perusahaan',
			'idkelompok' => 'Idkelompok',
			'idgudang' => 'Idgudang',
			'is_ketuakelompok' => 'Is Ketuakelompok',
			'is_moderator' => 'Is Moderator',
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
		$criteria->compare('nama_petani',$this->nama_petani,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('nmr_identitas',$this->nmr_identitas,true);
		$criteria->compare('tempat_lahir',$this->tempat_lahir,true);
		$criteria->compare('tanggal_lahir',$this->tanggal_lahir,true);
		$criteria->compare('luas_lokasi',$this->luas_lokasi);
		$criteria->compare('jenis_komoditi',$this->jenis_komoditi,true);
		$criteria->compare('kadar_air',$this->kadar_air);
		$criteria->compare('jumlah_bentangan',$this->jumlah_bentangan);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_perusahaan',$this->id_perusahaan);
		$criteria->compare('idkelompok',$this->idkelompok);
		$criteria->compare('idgudang',$this->idgudang);
		$criteria->compare('is_ketuakelompok',$this->is_ketuakelompok);
		$criteria->compare('is_moderator',$this->is_moderator);
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
	 * @return TabelPetani the static model class
	 */
	public static function model($className=__CLASS__)
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
    public function getPetaniKomoditi($id_user){
      $models = TabelPetani::model()->findByAttributes(array('id'=>$id_user));
      
      return $models->nama_petani;
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
	public function getJabatanPetani($id){
		$query = Pengguna::model()->findByAttributes(array('id'=>$id));
		$query2 = TabelPetani::model()->findByAttributes(array('id_user'=>$id));
		$jabatan = "";
		if($query2->is_ketuakelompok == 1){
			$jabatan = "Ketua Kelompok";
			if($query2->is_moderator == 1){
				$jabatan = $jabatan."<br/>Moderator";
			}
		}elseif($query2->is_moderator == 1){
			$jabatan = "Moderator";
			if($query2->is_ketuakelompok == 1){
				$jabatan = $jabatan."<br/>Ketua Kelompok";
			}
			
		}else{
			$jabatan = "Petani Rumput Laut";
		}
		return $jabatan;
	}
	public function komoditilist(){
		$models = TabelPetani::model()->findAll(array('condition' => 'id = ' . $this->id, 'order'=> 'id'));
		foreach ($models as $model)
			$_items[$model->id] = $model->nama;
		return $_items;
	}

}
