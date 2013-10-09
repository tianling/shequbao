<?php


class Area extends CActiveRecord
{
	
	public function tableName()
	{
		return '{{area}}';
	}

	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fid, level, lft, rgt, area_name', 'required'),
			array('fid, level, lft, rgt', 'length', 'max'=>11),
			array('area_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fid, level, lft, rgt, area_name', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'communities' => array(self::HAS_MANY, 'Community', 'location'),
			'userAddresses' => array(self::HAS_MANY, 'UserAddress', 'location'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fid' => 'Fid',
			'level' => 'Level',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'area_name' => 'Area Name',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('fid',$this->fid,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('area_name',$this->area_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
