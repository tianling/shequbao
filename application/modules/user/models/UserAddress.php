<?php

/**
 * This is the model class for table "{{user_address}}".
 *
 * The followings are the available columns in table '{{user_address}}':
 * @property string $id
 * @property string $user_id
 * @property string $location
 * @property string $address
 * @property string $community
 * @property string $building
 * @property string $property
 * @property string $water
 * @property string $electricity
 * @property string $gas
 * @property string $garbage
 * @property string $room
 * @property string $help_mark
 * @property string $contact_phone
 * @property string $household
 *
 * The followings are the available model relations:
 * @property SqbUser $user
 * @property Area $location
 * @property Community $community
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
			array('user_id,household,gas,water,electricity','unsafe','on'=>'appUpdate'),
			array('user_id, location, water, electricity, gas, garbage, contact_phone, household', 'required','message'=>'{attribute}不存在'),
			array('user_id, location, community, property', 'length', 'max'=>11,'message'=>'{attribute}不能多于11个字符'),
			array('location','exist','className'=>'Area','attributeName'=>'id','message'=>'选择的{attribute}不存在'),
			//array('community','exist','className'=>'cms.models.Community','message'=>'选择的{attribute}不存在'),
			array('gas','unionUnique','unionAttributes'=>array('user_id','water','electricity'),'message'=>'{attribute}已存在'),
			array('address', 'length', 'max'=>255,'message'=>'{attribute}不能多于255个字符'),
			array('building, room', 'length', 'max'=>10,'message'=>'{attribute}不能多于10个字符'),
			array('water, electricity, gas, garbage', 'length', 'max'=>30,'message'=>'{attribute}不能多于30个字符'),
			array('help_mark', 'length', 'max'=>20,'message'=>'{attribute}不能多于20个字符'),
			array('contact_phone', 'length', 'max'=>15,'message'=>'{attribute}不能多于15个字符'),
			array('household', 'length', 'max'=>5,'message'=>'{attribute}不能多于5个字符'),
			array('id, user_id, location, address, community, building, property, water, electricity, gas, garbage, room, help_mark, contact_phone, household', 'safe', 'on'=>'search'),
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
			'location' => array(self::BELONGS_TO, 'Area', 'location'),
			'community' => array(self::BELONGS_TO, 'Community', 'community'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '住址',
			'user_id' => '用户',
			'location' => '地域',
			'address' => '详细地址',
			'community' => '小区',
			'building' => '楼栋号',
			'property' => '物业',
			'gas' => '业主',
			'garbage' => '垃圾号',
			'room' => '房间号',
			'help_mark' => '助记号',
			'contact_phone' => '联系电话',
			'household' => '业主',
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
		$criteria->compare('location',$this->location,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('community',$this->community,true);
		$criteria->compare('building',$this->building,true);
		$criteria->compare('property',$this->property,true);
		$criteria->compare('water',$this->water,true);
		$criteria->compare('electricity',$this->electricity,true);
		$criteria->compare('gas',$this->gas,true);
		$criteria->compare('garbage',$this->garbage,true);
		$criteria->compare('room',$this->room,true);
		$criteria->compare('help_mark',$this->help_mark,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('household',$this->household,true);

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
	
	/**
	 * get a user's addresses
	 * 
	 * @author lancelot <cja.china@gmail.com>
	 * @param int $userId
	 * @return array
	 */
	public function getUserAddressesArray($userId){
		$criteria = new CDbCriteria();
		$criteria->with = array('community');
		$criteria->condition = 'user_id=:uid';
		$criteria->params = array(':uid'=>$userId);
	
		$address = $this->findAll($criteria);
		$data = array();
		foreach ( $address as $i => $addr ){
			$community = $addr->getRelated('community');
			$cData = array();
			if ( $community !== null ){
				$cData = array(
						'id' => $community->getPrimaryKey(),
						'name' => $community->getAttribute('community_name')
				);
			}
			$data[$i] = $addr->getAttributes();
			$data[$i]['community'] = $cData;
		}
		
		return $data;
	}
}
