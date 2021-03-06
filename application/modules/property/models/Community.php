<?php

/**
 * This is the model class for table "{{community}}".
 *
 * The followings are the available columns in table '{{community}}':
 * @property string $id
 * @property string $auth_goups
 * @property string $location
 * @property string $community_name
 *
 * The followings are the available model relations:
 * @property ChatRoom[] $chatRooms
 * @property AuthGroups $authGoups
 * @property Area $location0
 * @property SqbUser[] $xcmsSqbUsers
 * @property Property[] $xcmsProperties
 * @property UserAddress[] $userAddresses
 */
class Community extends CmsActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{community}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('location, community_name', 'required'),
			array('auth_goups, location', 'length', 'max'=>11),
			array('community_name', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, auth_goups, location, community_name', 'safe', 'on'=>'search'),
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
			'area' => array(self::BELONGS_TO,'Area','location'),
			'chatRooms' => array(self::HAS_MANY, 'ChatRoom', 'community_id'),
			'authGoups' => array(self::BELONGS_TO, 'AuthGroups', 'auth_goups'),
			'location0' => array(self::BELONGS_TO, 'Area', 'location'),
			'xcmsSqbUsers' => array(self::MANY_MANY, 'SqbUser', '{{community_user}}(community_id, user_id)'),
			'xcmsProperties' => array(self::MANY_MANY, 'Property', '{{property_community}}(community_id, property_id)'),
			'userAddresses' => array(self::HAS_MANY, 'UserAddress', 'community'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'auth_goups' => 'Auth Goups',
			'location' => 'Location',
			'community_name' => 'Community Name',
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
		$criteria->compare('auth_goups',$this->auth_goups,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('community_name',$this->community_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Community the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
