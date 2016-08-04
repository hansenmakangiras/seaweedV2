<?php

  /**
   * This is the model class for table "users".
   *
   * The followings are the available columns in table 'users':
   * @property integer                    $id
   * @property integer                    $groupid
   * @property string                     $komoditi
   * @property string                     $username
   * @property string                     $password
   * @property string                     $email
   * @property string                     $no_handphone
   * @property string                     $created_date
   * @property string                     $updated_date
   * @property integer                    $levelid
   * @property integer                    $isadmin
   * @property integer                    $superuser
   * @property integer                    $status
   * @property string                     $last_login
   *
   * The followings are the available model relations:
   * @property Profiles[]                 $profiles
   */
  class Users extends CActiveRecord
  {
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
      return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
      // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      return array(
        array('komoditi', 'required'),
        array('levelid, isadmin, superuser, status', 'numerical', 'integerOnly' => true),
        array('komoditi', 'length', 'max' => 200),
        array('username', 'length', 'max' => 100),
        array('password', 'length', 'max' => 150),
        array('email', 'length', 'max' => 255),
        array('no_handphone', 'length', 'max' => 15),
        array('created_date, updated_date,last_login', 'safe'),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array(
          'id, komoditi, username, password, email, no_handphone, created_date, updated_date, levelid, isadmin, superuser, status, last_login',
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
        'profiles'                  => array(self::HAS_MANY, 'Profiles', 'userid'),
        'level'                  => array(self::HAS_MANY, 'Level', 'id'),
        'groups'                  => array(self::HAS_MANY, 'Group', 'userid'),
      );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id'           => 'ID',
        'komoditi'     => 'Komoditi',
        'username'     => 'Username',
        'password'     => 'Password',
        'email'        => 'Email',
        'no_handphone' => 'No Handphone',
        'created_date' => 'Created Date',
        'updated_date' => 'Updated Date',
        'levelid'      => 'Level',
        'isadmin'      => 'Admin',
        'superuser'    => 'Superuser',
        'status'       => 'Status',
        'last_login'   => 'Last Login',
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
      $criteria->compare('komoditi', $this->komoditi, true);
      $criteria->compare('username', $this->username, true);
      $criteria->compare('password', $this->password, true);
      $criteria->compare('email', $this->email, true);
      $criteria->compare('no_handphone', $this->no_handphone, true);
      $criteria->compare('created_date', $this->created_date, true);
      $criteria->compare('updated_date', $this->updated_date, true);
      $criteria->compare('levelid', $this->levelid);
      $criteria->compare('isadmin', $this->isadmin);
      $criteria->compare('superuser', $this->superuser);
      $criteria->compare('status', $this->status);
      $criteria->compare('last_login', $this->last_login, true);

      return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        'pagination' => array(
          'pageSize' => 10
        ),
      ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
      return parent::model($className);
    }

    /* set created_date and hash the password before save is triggered */
    public function beforeSave()
    {
      if ($this->isNewRecord) {

        $this->created_date = date('Y-m-d H:i:s');
        //$this->created_date = date('Y-m-d H:i:s');
        $this->password = $this->hashPassword($this->password);

      } else {

        $this->updated_date = date('Y-m-d H:i:s');

      }

      return parent::beforeSave();
    }

//    public function afterSave()
//    {
//      if ($this->isNewRecord) {
//        $this->saveKomoditiToTable($this->getKomoditiTipe());
//      } else {
//        echo $this->model()->errors;
//      }
//
//      return parent::afterSave();
//    }

    /**
     * Checks if the given password is correct.
     * @param string $password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
      if (CPasswordHelper::verifyPassword($password, $this->password)) {
        return true;
      }

      return false;
    }

    /**
     * Generates the password hash.
     * @param string $password
     * @return string hash
     */
    public function hashPassword($password)
    {
      return CPasswordHelper::hashPassword($password);
    }

    public function checkLevel($id)
    {
      $model = array();
      if ($id) {
        $model = Users::model()->findByPk($id, 'superuser = 1');
      }

      return $model->attributes;
    }

    public function isSuperUser()
    {
      $check = Yii::app()->user->isSuperUser;
      $check = (int)$check;

      return ($check === 1) ? true : false;
    }

    public function isAdmin()
    {
      $check = Yii::app()->user->isAdmin;
      $check = (int)$check;

      return ($check === 1) ? true : false;
    }

    public function saveKomoditiToTable($data)
    {
      if (is_array($data)) {
        $komoditi = new Komoditi();
        $komoditi->setScenario('insert');
        $komoditi->unsetAttributes();

        foreach ($data as $item) {
          $komoditi->nama_komoditi = $item;
          $komoditi->id_user = Yii::app()->user->id;
          $komoditi->jenis_komoditi = 1;
          $komoditi->kadar_air = 0;
          $komoditi->jumlah_bentangan = 0;
          $komoditi->status = 1;
        }

        if ($komoditi->save()) {
          Helper::dd($komoditi);
        } else {
          Helper::dd($komoditi->model()->errors);
        }
      } else {
        Helper::dd('Data is not an array');
      }
    }

    public function getKomoditiTipe()
    {
      return CHtml::listData(Users::model()->findAll('superuser = 0'), 'id', 'komoditi');
    }

    public function getUserName($id){
      $id = isset($id) ? (int) $id : 0;
      if($id){
        $user = $this->findByPk($id);
        return $user->username;
      }
    }
  }
