<?php

/**
 * This is the model class for table "{{user_address}}".
 *
 * The followings are the available columns in table '{{user_address}}':
 * @property string $id
 * @property string $user_id
 * @property string $province
 * @property string $city
 * @property string $address
 * @property string $community
 * @property string $building
 * @property string $property
 * @property string $room
 * @property string $help_mark
 * @property string $contact_phone
 * @property string $hosehold
 *
 * The followings are the available model relations:
 * @property SqbUser $user
 * @property Area $province0
 * @property Area $city0
 */
class UserAddress extends CmsActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_address}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id','required','on'=>'update','message'=>'{attribute}不存在'),
			array('user_id, province, city, community, contact_phone, hosehold', 'required'),
			array('user_id, province, city, community, building, property', 'length', 'max'=>11),
			array('address', 'length', 'max'=>255,'message'=>'{attribute}过长'),
			array('room', 'length', 'max'=>10,'message'=>'{attribute}过长'),
			array('help_mark', 'length', 'max'=>20,'message'=>'{attribute}过长'),
			array('contact_phone', 'length', 'max'=>15,'message'=>'{attribute}过长'),
			array('hosehold', 'length', 'max'=>5,'message'=>'{attribute}过长'),
			array('user_id', 'safe'),
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
			'user' => array(self::BELONGS_TO, 'SqbUser', 'user_id'),
			'province0' => array(self::BELONGS_TO, 'Area', 'province'),
			'city0' => array(self::BELONGS_TO, 'Area', 'city'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户ID',
			'province' => '省份ID',
			'city' => '城市ID',
			'address' => '详细地址',
			'community' => '小区ID',
			'building' => '楼栋ID',
			'property' => '物业ID',
			'room' => '房间号',
			'help_mark' => '助记号',
			'contact_phone' => '联系点好',
			'hosehold' => '户主名称',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('community',$this->community,true);
		$criteria->compare('building',$this->building,true);
		$criteria->compare('property',$this->property,true);
		$criteria->compare('room',$this->room,true);
		$criteria->compare('help_mark',$this->help_mark,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('hosehold',$this->hosehold,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
