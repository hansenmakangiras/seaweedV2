<?php

  /**
   * This is the model class for table "komoditi".
   *
   * The followings are the available columns in table 'komoditi':
   * @property integer $id
   * @property string  $id_komoditi
   * @property string  $nama_komoditi
   * @property string  $deskripsi
   * @property double  $kadar_air
   * @property double  $jumlah_bentangan
   * @property integer $status
   * @property double  $total_panen
   * @property integer $id_user
   * @property string  $created_date
   * @property string  $created_by
   * @property string  $updated_date
   * @property string  $updated_by
   */
  class Komoditi extends CActiveRecord
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
      return 'komoditi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
      // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      return array(
        //array('id_komoditi, nama_komoditi, kadar_air, total_panen', 'required'),
        array('status, id_user', 'numerical', 'integerOnly' => true),
        array('kadar_air, jumlah_bentangan, total_panen', 'numerical'),
        array('id_komoditi', 'length', 'max' => 50),
        array('nama_komoditi', 'length', 'max' => 255),
        array('created_by, updated_by', 'length', 'max' => 150),
        array('deskripsi, created_date, updated_date', 'safe'),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array(
          'id, id_komoditi, nama_komoditi, deskripsi, kadar_air, jumlah_bentangan, status, total_panen, id_user, created_date, created_by, updated_date, updated_by',
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
        'id_komoditi'      => 'Id Komoditi',
        'nama_komoditi'    => 'Nama Komoditi',
        'deskripsi'        => 'Deskripsi',
        'kadar_air'        => 'Kadar Air',
        'jumlah_bentangan' => 'Jumlah Bentangan',
        'status'           => 'Status',
        'total_panen'      => 'Total Panen',
        'id_user'          => 'Id User',
        'created_date'     => 'Created Date',
        'created_by'       => 'Created By',
        'updated_date'     => 'Updated Date',
        'updated_by'       => 'Updated By',
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
      $criteria->compare('id_komoditi', $this->id_komoditi, true);
      $criteria->compare('nama_komoditi', $this->nama_komoditi, true);
      $criteria->compare('deskripsi', $this->deskripsi, true);
      $criteria->compare('kadar_air', $this->kadar_air);
      $criteria->compare('jumlah_bentangan', $this->jumlah_bentangan);
      $criteria->compare('status', $this->status);
      $criteria->compare('total_panen', $this->total_panen);
      $criteria->compare('id_user', $this->id_user);
      $criteria->compare('created_date', $this->created_date, true);
      $criteria->compare('created_by', $this->created_by, true);
      $criteria->compare('updated_date', $this->updated_date, true);
      $criteria->compare('updated_by', $this->updated_by, true);

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
     * @return Komoditi the static model class
     */
    public static function model($className = __CLASS__)
    {
      return parent::model($className);
    }

    public function getSummarySeaweed()
    {
      $order = 'sango-sango laut,euchema cotoni,spinosom,gracillaria kw 3,gracillaria kw 4,gracillaria bs';
      $query = Yii::app()->db->createCommand('SELECT nama_komoditi,sum(total_panen) as total_panen ,SUM(jumlah_bentangan) as jumlah_bentangan,sum(kadar_air) as kadar_air from komoditi GROUP BY nama_komoditi ORDER BY (
			CASE WHEN nama_komoditi = "sango-sango laut" THEN 1 
				 WHEN nama_komoditi= "spinosom" THEN 2
				 WHEN nama_komoditi= "euchema cotoni" THEN 3
				 WHEN nama_komoditi= "gracillaria kw 3" THEN 4
				 WHEN nama_komoditi= "gracillaria kw 4" THEN 5
				 WHEN nama_komoditi= "gracillaria bs" THEN 6 END)')
        // ->select('nama_komoditi,sum(total_panen) as total,sum(kadar_air) as kadar,sum(jumlah_bentangan) as jumlah')
        // ->from('komoditi')
        // ->group('nama_komoditi')
        // ->order('FIELD(nama_komoditi,sango-sango laut,euchema cotoni,spinosom,gracillaria kw 3,gracillaria kw 4,gracillaria bs)')
        ->queryAll();

      return $query;
    }

    public function getPanenPetani($id)
    {
      // $order = 'sango-sango laut,euchema cotoni,spinosom,gracillaria kw 3,gracillaria kw 4,gracillaria bs';
      // $query = Yii::app()->db->createCommand('SELECT nama_komoditi,sum(total_panen) as total_panen ,sum(kadar_air) as kadar_air from komoditi WHERE id_user="'$id'" GROUP BY nama_komoditi ORDER BY (
      // CASE WHEN nama_komoditi = "sango-sango laut" THEN 1
      //    WHEN nama_komoditi= "spinosom" THEN 2
      //    WHEN nama_komoditi= "euchema cotoni" THEN 3
      //    WHEN nama_komoditi= "gracillaria kw 3" THEN 4
      //    WHEN nama_komoditi= "gracillaria kw 4" THEN 5
      //    WHEN nama_komoditi= "gracillaria bs" THEN 6 END)')
      //   ->queryAll();
      //   helper::dd($query);
      // return $query;
    }

    public function getSummarySeaweedAll()
    {
      $order = 'sango-sango laut,euchema cotoni,spinosom,gracillaria kw 3,gracillaria kw 4,gracillaria bs';
      $query = Yii::app()->db->createCommand('SELECT nama_komoditi, SUM(total_panen) as total_panen , SUM(jumlah_bentangan) as jumlah_bentangan,sum(kadar_air) as kadar_air from komoditi GROUP BY id_komoditi ')
        // ->select('nama_komoditi,sum(total_panen) as total,sum(kadar_air) as kadar,sum(jumlah_bentangan) as jumlah')
        // ->from('komoditi')
        // ->group('nama_komoditi')
        // ->order('FIELD(nama_komoditi,sango-sango laut,euchema cotoni,spinosom,gracillaria kw 3,gracillaria kw 4,gracillaria bs)')
        ->queryAll();

      return $query;
    }

    public function getSumPanen()
    {
      $order = 'sango-sango laut, euchema cotoni, spinosom, gracillaria kw 3, gracillaria kw 4, gracillaria bs';
      $query = Yii::app()->db->createCommand('SELECT nama_komoditi,SUM(total_panen) as total_panen , SUM(kadar_air) as kadar_air from komoditi GROUP by nama_komoditi')
        ->queryAll();
        //helper::dd($query);
        $apa = array();
        for($i=0;$i<=5;$i++){
          if(!empty($query[$i]) && $query[$i]['nama_komoditi']=='Sango-Sango Laut'){
            $apa[0]=$query[$i];
          }
        
        }
        for($i=0;$i<=5;$i++){
          if(!empty($query[$i]) && $query[$i]['nama_komoditi']=='Spinosom'){
            $apa[1]=$query[$i];
          }
        }
        for($i=0;$i<=5;$i++){
          if(!empty($query[$i]) && $query[$i]['nama_komoditi']=='Euchema Cotoni'){
            $apa[2]=$query[$i];
          }
        }
        for($i=0;$i<=5;$i++){
          if(!empty($query[$i]) && $query[$i]['nama_komoditi']=='Gracillaria KW 3'){
            $apa[3]=$query[$i];
          }
        }
        for($i=0;$i<=5;$i++){
          if(!empty($query[$i]) && $query[$i]['nama_komoditi']=='Gracillaria KW 4'){
            $apa[4]=$query[$i];
          }
        }

        for( $i=0;$i<=5;$i++){
          if(!empty($query[$i]) && $query[$i]['nama_komoditi']=='Gracillaria BS'){
            $apa[5]=$query[$i];
          }
        }
        
      return $apa;
    }

    public function getSumGroupPanen()
    {
      //helper::dd($id);
      $query = Yii::app()->db->createCommand('SELECT id_user, SUM(total_panen) as total_panen ,SUM(jumlah_bentangan) as jumlah_bentangan, SUM(kadar_air) as kadar_air from komoditi group by id_user')
        //->where('id_user=:id',array(':id'=>$id))
        ->queryAll();

      return $query;
    }

    public function getGrafik($year)
    {
      //helper::dd($year);
      $query = Yii::app()->db->createCommand()
        ->select('id_komoditi,sum(total_panen) as total_panen')
        ->from('komoditi')
        ->where(array('LIKE', 'created_date', '%' . $year . '%'))
        ->group('id_komoditi')
        ->queryAll();
      // $query = Yii::app()->db->createCommand('SELECT id_komoditi,sum(total_panen) as total_panen FROM komoditi WHERE created_date LIKE '$year'.'%' group by id_komoditi')
      // //->where('id_user=:id',array(':id'=>$id))
      //  	->queryAll();
      return $query;
    }

    public function getPanenFarmer($id)
    {
      $query = Yii::app()->db->createCommand()
        ->select('SUM(total_panen) as total_panen, sum(kadar_air) as kadar_air, sum(jumlah_bentangan) as jumlah_bentangan')
        ->from('komoditi')
        ->where('id_user=:id', array(':id' => $id))
        ->queryAll();

      return $query;
    }

    public function getAllPanen()
    {
      $query = Yii::app()->db->createCommand('select tabel_petani.id,tabel_petani.nama_petani,tabel_kelompok.nama_kelompok as kelompok,tabel_kelompok.lokasi, komoditi.nama_komoditi, komoditi.total_panen as total_panen,komoditi.kadar_air as kadar_air, komoditi.jumlah_bentangan as jumlah_bentangan,tabel_petani.status from tabel_petani INNER JOIN komoditi on tabel_petani.id_user=komoditi.id_user INNER JOIN tabel_kelompok ON tabel_petani.idkelompok = tabel_kelompok.id_user WHERE tabel_petani.status=komoditi.status')
        //->where('id_user=:id',array(':id'=>$id))
        ->queryAll();

      return $query;
    }

    public function getpanen(){
      $query = Yii::app()->db->createCommand('select komoditi.*,tabel_petani.nama_petani,tabel_petani.jumlah_bentangan,tabel_kelompok.nama_kelompok,gudang.lokasi from komoditi join tabel_petani on komoditi.id_user=tabel_petani.id join tabel_kelompok on tabel_petani.idkelompok=tabel_kelompok.id join gudang on tabel_kelompok.idgudang=gudang.id')
      ->queryAll();
      return $query;
      
    }

    public function getpanenKelompok()
    {
      $query = Yii::app()->db->createCommand('SELECT a.*,b.total from tabel_kelompok a LEFT JOIN v_komoditibygroup b on a.idgudang=b.idkelompok')
        //->where('id_user=:id',array(':id'=>$id))
        ->queryAll();

      return $query;
    }

    public function getnamapetani($status){
      $models = TabelPetani::model()->findAll(
        array(
          'condition' => 'status = :status',
          'params'    => array(':status' => $status),
        ));

      return CHtml::listData($models, 'nama_petani', 'nama_petani');
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
    public function getPetaniKomoditi($id_user){
      $models = TabelPetani::model()->findByAttributes(array('id'=>$id_user));
      
      return $models->nama_petani;
    }
    public function getReportPetani(){
      $query = Yii::app()->db->createCommand('SELECT tabel_petani.nama_petani,tabel_kelompok.nama_kelompok,gudang.lokasi,sum(komoditi.total_panen) as total_panen,sum(komoditi.kadar_air) as kadar_air,tabel_petani.jumlah_bentangan FROM tabel_petani LEFT JOIN komoditi on tabel_petani.id=komoditi.id_user JOIN tabel_kelompok ON tabel_petani.idkelompok=tabel_kelompok.id JOIN gudang ON tabel_kelompok.idgudang=gudang.id GROUP by tabel_petani.nama_petani')
      ->queryAll();
      return $query;
    }
}