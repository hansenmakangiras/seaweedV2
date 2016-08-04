<?php

  /**
   * This is the model class for table "seaweed".
   *
   * The followings are the available columns in table 'seaweed':
   * @property integer $id
   * @property integer $id_user
   * @property string  $nama_komoditi
   * @property integer $jenis_komoditi
   * @property integer $kadar_air
   * @property integer $jumlah_bentangan
   * @property double  $total_panen
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
        array('nama_komoditi, jenis_komoditi, kadar_air, jumlah_bentangan, total_panen', 'required'),
        array('id_user, jenis_komoditi, kadar_air, jumlah_bentangan, status', 'numerical', 'integerOnly' => true),
        array('total_panen', 'numerical'),
        array('nama_komoditi', 'length', 'max' => 255),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array(
          'id, id_user, nama_komoditi, jenis_komoditi, kadar_air, jumlah_bentangan, total_panen, status',
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
        'subs'                  => array(self::HAS_MANY, 'SubSeaweed', 'id'),
      );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
      return array(
        'id'               => 'ID',
        'id_user'          => 'Id User',
        'nama_komoditi'    => 'Nama Komoditi',
        'jenis_komoditi'   => 'Jenis Komoditi',
        'kadar_air'        => 'Kadar Air',
        'jumlah_bentangan' => 'Jumlah Bentangan',
        'total_panen'      => 'Total Panen',
        'status'           => 'Status',
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
      $criteria->compare('id_user', $this->id_user);
      $criteria->compare('nama_komoditi', $this->nama_komoditi, true);
      $criteria->compare('jenis_komoditi', $this->jenis_komoditi);
      $criteria->compare('kadar_air', $this->kadar_air);
      $criteria->compare('jumlah_bentangan', $this->jumlah_bentangan);
      $criteria->compare('total_panen', $this->total_panen);
      $criteria->compare('status', $this->status);

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
     * @return Seaweed the static model class
     */
    public static function model($className = __CLASS__)
    {
      return parent::model($className);
    }

    public function getSeaweedById($id)
    {
      if(isset($id)){
        $cmd = Yii::app()->db->createCommand();
        $cmd->select = "nama_komoditi";
        $cmd->from = $this->tableName();
        $cmd->where = "id = ".$id;
        $data = $cmd->queryRow();
        //Helper::dd($data);
        return $data;
      }
    }
  }
