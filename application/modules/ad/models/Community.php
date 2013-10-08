<?php


class Community extends CActiveRecord
{
	
	public function tableName()
	{
		return '{{community}}';
	}

	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('location, community_name', 'required'),
			array('location', 'length', 'max'=>11),
			array('community_name', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, location, community_name', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'chatRooms' => array(self::HAS_MANY, 'ChatRoom', 'community_id'),
			'id0' => array(self::BELONGS_TO, 'AuthGroups', 'id'),
			'location0' => array(self::BELONGS_TO, 'Area', 'location'),
			'xcmsSqbUsers' => array(self::MANY_MANY, 'SqbUser', '{{community_user}}(community_id, user_id)'),
			'xcmsProperties' => array(self::MANY_MANY, 'Property', '{{property_community}}(community_id, property_id)'),
			'userAddresses' => array(self::HAS_MANY, 'UserAddress', 'community'),
		);
	}



	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'location' => 'Location',
			'community_name' => 'Community Name',
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('community_name',$this->community_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
