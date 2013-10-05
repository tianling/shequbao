<?php

/**
 * This is the model class for table "{{administrators}}".
 *
 * The followings are the available columns in table '{{administrators}}':
 * @property string $id
 * @property string $surname
 * @property string $name
 *
 * The followings are the available model relations:
 * @property User $id0
 */
class Administrators extends SingleInheritanceModel
{
	protected $_parentRelation = 'baseUser';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{administrators}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'safe'),
			array('phone,email','required','message'=>'{attribute}不能为空'),
			array('surname, name', 'length', 'max'=>10),
			array('phone','unique','message'=>'手机号已经被注册'),
			array('email','unique','message'=>'邮箱已经被使用'),
			array('phone','length','is'=>11,'message'=>'手机号码错误'),
			array('email', 'length', 'max'=>50, 'message'=>'邮箱过长'),
			array('email', 'email', 'message'=>'邮箱格式不正确'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, surname, name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'surname' => 'Surname',
			'name' => 'Name',
			'phone' => '手机号',
			'email' => '邮箱'
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
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Administrators the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
