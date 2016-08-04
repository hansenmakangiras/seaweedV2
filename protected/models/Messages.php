<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id
 * @property integer $tagsid
 * @property string $subject
 * @property string $to
 * @property string $content
 * @property string $date_send
 * @property string $date_receive
 * @property integer $sent_status
 * @property integer $is_draft
 */
class Messages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tagsid, subject, to, content, date_send, date_receive', 'required'),
			array('tagsid, sent_status, is_draft', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>150),
			array('to', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tagsid, subject, to, content, date_send, date_receive, sent_status, is_draft', 'safe', 'on'=>'search'),
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
			'tagsid' => 'Tagsid',
			'subject' => 'Subject',
			'to' => 'To',
			'content' => 'Content',
			'date_send' => 'Date Send',
			'date_receive' => 'Date Receive',
			'sent_status' => 'Sent Status',
			'is_draft' => 'Is Draft',
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
		$criteria->compare('tagsid',$this->tagsid);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date_send',$this->date_send,true);
		$criteria->compare('date_receive',$this->date_receive,true);
		$criteria->compare('sent_status',$this->sent_status);
		$criteria->compare('is_draft',$this->is_draft);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
