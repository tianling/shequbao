<?php

/**
 * This is the model class for table "{{property_admin}}".
 *
 * The followings are the available columns in table '{{property_admin}}':
 * @property string $id
 * @property string $property_id
 * @property string $phone
 * @property string $email
 *
 * The followings are the available model relations:
 * @property User $id0
 * @property Property $property
 */
class PropertyAdmin extends SingleInheritanceModel
{
	protected $_parentRelation = 'baseUser';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{property_admin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id','safe'),
			array('property_id, phone, email', 'required','message'=>'{attribute}不能为空'),
			array('property_id','exist','className'=>'Property','attributeName'=>'id','message'=>'不存在此物管'),
			array('id, property_id, phone', 'length', 'max'=>11),
			array('email', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, phone, email', 'safe', 'on'=>'search'),
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
			'baseUser' => array(self::BELONGS_TO, 'UserModel', 'id'),
			'property' => array(self::BELONGS_TO, 'Property', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'property_id' => '物管',
			'phone' => '手机号',
			'email' => '邮箱',
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
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyAdmin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
