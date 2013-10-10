<?php

/**
 * This is the model class for table "{{property}}".
 *
 * The followings are the available columns in table '{{property}}':
 * @property string $id
 * @property string $property_name
 *
 * The followings are the available model relations:
 * @property Community[] $xcmsCommunities
 * @property PropertyPush[] $propertyPushes
 */
class Property extends CmsActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{property}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('property_name', 'required'),
			array('property_name', 'length', 'max'=>15),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'communities' => array(self::MANY_MANY, 'Community', '{{property_community}}(property_id, community_id)'),
			'propertyPushes' => array(self::HAS_MANY, 'PropertyPush', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'property_name' => '物管名称',
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
		$criteria->compare('property_name',$this->property_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Property the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
