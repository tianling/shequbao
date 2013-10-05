<?php

/**
 * This is the model class for table "{{advertiser}}".
 *
 * The followings are the available columns in table '{{advertiser}}':
 * @property string $advertiser_id
 * @property double $balance
 * @property string $phone
 *
 * The followings are the available model relations:
 * @property Advertise[] $advertises
 */
class Advertiser extends SingleInheritanceModel
{
	protected $_parentRelation = 'baseUser';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{advertiser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('advertiser_id', 'required','on'=>'update'),
			array('balance', 'numerical'),
			array('advertiser_id, phone', 'length', 'max'=>11),
			array('email', 'length', 'max'=>50, 'message'=>'邮箱过长'),
			array('email', 'email', 'message'=>'邮箱格式不正确'),
			array('email', 'unique', 'message'=>'邮箱已被注册'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('advertiser_id, balance, phone', 'safe', 'on'=>'search'),
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
			'advertises' => array(self::HAS_MANY, 'Advertise', 'advertiser_id'),
			'baseUser' => array(self::BELONGS_TO, 'UserModel', 'advertiser_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'advertiser_id' => 'Advertiser',
			'balance' => '余额',
			'phone' => ' 电话',
			'email' => 'Email',
			'ads' =>'广告数目',
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

		$criteria->compare('advertiser_id',$this->advertiser_id,true);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('phone',$this->phone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Advertiser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
