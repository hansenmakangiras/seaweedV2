<?php

  /**
   * This is the model class for table "level".
   *
   * The followings are the available columns in table 'level':
   * @property integer $id
   * @property string  $level
   * @property string  $deskripsi
   *
   * The followings are the available model relations:
   * @property Users[] $users
   */
  class Level extends CActiveRecord
  {
    //user rankings
    //possibly should be moved to the WebUser class?
    //the value of these constants match a group id in the group table
    const GUEST = 1;
    const USER = 2;
    const ADMIN = 3;
    const SUPER_ADMIN = 10;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
      return 'level';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
      // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      return array(
        array('level', 'length', 'max' => 150),
        array('deskripsi', 'length', 'max' => 255),
        array('level', 'required'),
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
        'users' => array(self::HAS_MANY, 'Users', 'levelid'),
      );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id'    => 'ID',
        'level' => 'Role',
        'deskripsi'  => 'Deskripsi',
      );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return Level the static model class
     */
    public static function model($className = __CLASS__)
    {
      return parent::model($className);
    }

    public function getListed()
    {
      $a = $this->findAll();
      unset($a[0]); //removes "admin" level
      return $a;
    }

    public function getLevel()
    {
      return CHtml::listData(Level::model()->findAll(), 'id', 'level');
    }

    public function getLevelName($level){
      $levels = $this->getLevel();
      $name = "";
      foreach ($levels as $level) {
        if($level === $level){
          $name = "Guest";
        }elseif ($level === self::GUEST){

        }
      }

    }
  }
