<?php

/**
 * This is the model class for table "{{property_push}}".
 *
 * The followings are the available columns in table '{{property_push}}':
 * @property string $id
 * @property string $property_id
 * @property string $title
 * @property string $content
 * @property string $send_time
 * @property integer $push_type
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Property $property
 * @property PropertyPushReceiver $propertyPushReceiver
 */
class PropertyPush extends CmsActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{property_push}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_id, title, content, send_time, push_type, status', 'required'),
			array('push_type, status', 'numerical', 'integerOnly'=>true),
			array('property_id, send_time', 'length', 'max'=>11),
			array('title', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, title, content, send_time, push_type, status', 'safe', 'on'=>'search'),
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
			'property' => array(self::BELONGS_TO, 'Property', 'property_id'),
			'propertyPushReceiver' => array(self::HAS_ONE, 'PropertyPushReceiver', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'property_id' => 'Property',
			'title' => 'Title',
			'content' => 'Content',
			'send_time' => 'Send Time',
			'push_type' => 'Push Type',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('send_time',$this->send_time,true);
		$criteria->compare('push_type',$this->push_type);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyPush the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
