<?php

/**
 * This is the model class for table "{{sqb_user}}".
 *
 * The followings are the available columns in table '{{sqb_user}}':
 * @property string $id
 * @property string $identity_id
 * @property integer $gender
 * @property string $mobile
 * @property string $phone
 * @property string $groups
 * @property string $attention
 * @property string $be_attentioned
 * @property integer $online_status
 *
 * The followings are the available model relations:
 * @property Community[] $xcmsCommunities
 * @property UserModel $baseUser
 * @property UserAddress[] $userAddresses
 * @property UserContacts[] $userContacts
 * @property UserIcon[] $userIcons
 */
class SqbUser extends SingleInheritanceModel
{
	/**
	 * @var string
	 */
	protected $_parentRelation = 'baseUser';
	/**
	 * @var array
	 */
	protected $_uuidDependence = array('mobile','email','password');
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sqb_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('id','required','on'=>'update','message'=>'{attribute}不存在'),
			array('mobile,email', 'required','message'=>'{attribute}不能为空'),
			array('mobile','unique','message'=>'{attribute}已存在'),
			array('mobile', 'length', 'is'=>11, 'message'=>'{attribute}不正确'),
			array('email', 'length', 'max'=>50, 'message'=>'{attribute}过长'),
			array('email', 'email', 'message'=>'{attribute}格式不正确'),
			array('email', 'unique', 'message'=>'{attribute}已被注册'),
			array('identity_id', 'length', 'max'=>18,'message'=>'{attribute}过长'),
			array('phone', 'length', 'max'=>20,'message'=>'{attribute}过长'),
			array('identity_id,gender,online_status,be_attentioned,attention,groups','safe'),
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
			'communities' => array(self::MANY_MANY, 'Community', '{{community_user}}(user_id, property_id)'),
			'baseUser' => array(self::BELONGS_TO, 'UserModel', 'id'),
			'addresses' => array(self::HAS_MANY, 'UserAddress', 'user_id'),
			'contacts' => array(self::HAS_MANY, 'UserContacts', 'user_id'),
			'icon' => array(self::HAS_MANY, 'UserIcon', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '用户ID',
			'identity_id' => '身份证号码',
			'gender' => '性别',
			'mobile' => '手机号码',
			'email' => '邮箱',
			'phone' => '座机号码',
			'groups' => '群数量',
			'attention' => '关注的用户数量',
			'be_attentioned' => '关注我的用户数量',
			'online_status' => '在线状态',
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
		$criteria->compare('identity_id',$this->identity_id,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('groups',$this->groups,true);
		$criteria->compare('attention',$this->attention,true);
		$criteria->compare('be_attentioned',$this->be_attentioned,true);
		$criteria->compare('online_status',$this->online_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SqbUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
