<?php
class Pengguna extends CActiveRecord
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
		return 'pengguna';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id_perusahaan, levelid, username, level_user, is_moderator', 'required'),
			array('id_perusahaan, levelid, idkelompok, idkoordinator, status, level_user, is_moderator', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>100),
			array('password', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_perusahaan, levelid, username, password, idkelompok, idkoordinator, status, level_user, is_moderator', 'safe', 'on'=>'search'),
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
			'id_perusahaan' => 'Id Perusahaan',
			'levelid' => 'Levelid',
			'username' => 'Username',
			'password' => 'Password',
			'idkelompok' => 'Idkelompok',
			'idkoordinator' => 'Idkoordinator',
			'status' => 'Status',
			'level_user' => 'Level User',
			'is_moderator' => 'Is Moderator',
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
		$criteria->compare('id_perusahaan',$this->id_perusahaan);
		$criteria->compare('levelid',$this->levelid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('idkelompok',$this->idkelompok);
		$criteria->compare('idkoordinator',$this->idkoordinator);
		$criteria->compare('status',$this->status);
		$criteria->compare('level_user',$this->level_user);
		$criteria->compare('is_moderator',$this->is_moderator);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pengguna the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
  public function getLevel()
    {
      return CHtml::listData(Level::model()->findAll(), 'levelid', 'levelid');
    }

    public function getIdKor($id)
    {
      $models = Pengguna::model()->findAll(
        array(
          'condition' => 'levelid = :id AND status = :status',
          'params'    => array(':id' => $id, ':status' => 1),
        )
      );

      return CHtml::listData($models, 'id', 'id');
    }

    public function getNamaKor($id)
    {
      //$koordinator = Pengguna::model()->findByAttributes(array())
      $models = Gudang::model()->findAll(
        array(
          'condition' => 'id_perusahaan = :id_perusahaan',
          'params'    => array(':id_perusahaan' => 4),
        )
      );

      return CHtml::listData($models, 'id', 'id');
    }

    public function getIdKel()
    {
      $models = Pengguna::model()->findAll(
        array(
          'condition' => 'levelid = :id AND status = :status',
          'params'    => array(':id' => 2, ':status' => 1),
        )
      );

      return CHtml::listData($models, 'id', 'id');
    }
    // public function checkStatusPengguna($id){
    //  $query = Yii::app()->db->createCommand()
    //  ->select('status')
    //  ->from('pengguna')
    //  ->where('username=:id', array(':id'=>$id))
    //  ->queryRow();
    //        return $query;
    // }
    public function beforeSave()
    {
      if ($this->isNewRecord) {
        //$this->created_date = Date('Y-m-d H:i:s');

        // $salt = openssl_random_pseudo_bytes(22);
        // $salt = '$2a$%13$' . strtr(base64_encode($salt), array('_' => '.', '~' => '/'));

        //$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);

        //$this->password = crypt($this->password, $salt);
        $this->password = CPasswordHelper::hashPassword($this->password);
      } else {
        //$this->updated_date = Date('Y-m-d H:i:s');
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

    public function checkStatusPengguna($id)
    {
      $id = isset($id) ? strtoupper($id) : '';
      if ($id) {
        $status = Pengguna::model()->findByAttributes(array('username' => $id));

        return $status;
      }
    }

    public function changeStatusPetani($idkelompok, $status)
    {
      $query = Yii::app()->db->createCommand()
        ->update('pengguna', array(
          'status' => $status,
        ),
          'username=:id', array(':id' => $idkelompok));
    }

    public function changeStatusKelompok($idkoordinator, $status)
    {
      $query = Yii::app()->db->createCommand()
        ->update('pengguna', array(
          'status' => $status,
        ),
          'idkoordinator=:id', array(':id' => $idkoordinator));
    }

    public function changeStatusKelompokPetani($username, $level, $status)
    {
      if ($level == '2') {
        $query = Yii::app()->db->createCommand()
          ->update('tabel_kelompok', array(
            'status' => $status,
          ),
            'id_user=:id', array(':id' => $username));
      } elseif ($level == '3') {
        $query = Yii::app()->db->createCommand()
          ->update('tabel_petani', array(
            'status' => $status,
          ),
            'id_user=:id', array(':id' => $username));
      }
    }

    public function getUser()
    {
      $sql = "SELECT a.id, a.komoditi,a.username,a.password,a.isadmin,a.superuser, c.levelakses FROM seaweed.users a, seaweed.users_group b, seaweed.`level` c
              WHERE a.id = b.userid AND c.levelid = b.levelid AND a.id = 3 AND a.isadmin = 1";
      $cmd = Yii::app()->db->createCommand($sql);
      $data = $cmd->queryAll();

      return $data;
    }

    public function getIdKoordinator($id_perusahaan, $status)
    {
      $models = Gudang::model()->findAll('status = 1');
      return CHtml::listData($models, 'id', 'lokasi');
    }

    public function getIdKelompok($id_perusahaan, $status)
    {
      $models = TabelKelompok::model()->findAll(
        array(
          'condition' => 'id_perusahaan = :id_perusahaan AND status = :status',
          'params'    => array(':id_perusahaan' => $id_perusahaan, ':status' => $status),
        ));

      return CHtml::listData($models, 'nama_kelompok', 'nama_kelompok');
    }

    public function getGenderOptions()
    {
      return array('M' => 'Male', 'F' => 'Female');
    }

    public function getListUsers(){
      return CHtml::listData(self::model()->findAll(), 'id', 'username');
    }

    public function getUserProfiles(){
      $sql = "SELECT a.id, a.username, b.nama_lengkap, a.levelid FROM pengguna a, `profiles` b WHERE a.id = b.userid";
      $cmd = Yii::app()->db->createCommand($sql);
      $data = $cmd->queryAll();

      return $data;
    }
    public function getgroup($id){
      $query = Yii::app()->db->createCommand()
      ->select('nama_kelompok,idgudang')
      ->from('tabel_kelompok')
      ->where('id=:id',array(':id'=>$id))
      ->queryAll();

      return $query;
    }
    public function getUserName($id){
      $id = isset($id) ? (int) $id : 0;
      if($id){
        $user = $this->findByPk($id);
        return !empty($user) ? $user->username : null;
      }
    }

    public function getNamapetani($lokasi_gudang){
      $models = TabelPetani::model()->findAll(
        array(
          'condition' => 'idgudang = :idgudang',
          'params'    => array(':idgudang' => $lokasi_gudang),
        ));
      return CHtml::listData($models, 'nama_petani', 'nama_petani');
    }
    public function getNamapetaniKelompok($idkelompok,$idgudang){
      //helper::dd($idgudang);
     $models = TabelPetani::model()->findAll(
        array(
          'condition' => 'idgudang = :idgudang AND idkelompok = :idkelompok',
          'params'    => array(':idgudang' => $idgudang, ':idkelompok'=>$idkelompok),
        ));
     //helper::dd($models);
      return CHtml::listData($models, 'nama_petani', 'nama_petani'); 
    }
    public function getNamaKelompok(){
      $query = Gudang::model()->findAll(
        array(
          'condition' => 'status = :status',
          'params'    => array(':status'=>1),
      ));
      return $query;
    }
}
