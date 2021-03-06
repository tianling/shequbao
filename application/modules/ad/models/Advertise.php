<?php

/**
 * This is the model class for table "{{advertise}}".
 *
 * The followings are the available columns in table '{{advertise}}':
 * @property string $id
 * @property string $advertiser_id
 * @property string $title
 * @property string $content
 * @property integer $view
 * @property integer $click
 * @property string $direct_to
 * @property integer $pay_type
 * @property double $cpm
 * @property double $cpc
 * @property integer $priority
 *
 * The followings are the available model relations:
 * @property AdViewClick[] $adViewClicks
 * @property Advertiser $advertiser
 * @property AdvertisePic $advertisePic
 */
class Advertise extends CmsActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{advertise}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('advertiser_id, title, content, direct_to,cpc', 'required'),
			array('advertiser_id','exist','className'=>'Advertiser','attributeName'=>'advertiser_id','message'=>'广告主不存在'),
			array('pay_type, priority,cpm, cpc,community', 'numerical', 'integerOnly'=>true),
			array('view, click','safe'),
			array('cpc','numerical','min'=>0,'allowEmpty'=>false,'message'=>'{attribute}不能小于0'),
			array('advertiser_id', 'length', 'max'=>11),
			array('title', 'length', 'max'=>20),
			array('direct_to', 'length', 'max'=>255),
			array('id, advertiser_id, title, content, view, click, direct_to, pay_type, cpm, cpc, priority, community', 'safe', 'on'=>'search'),
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
			'adView' => array(self::HAS_MANY, 'AdViewClick', 'advertise_id','condition'=>'type=0'),
			'adClick' => array(self::HAS_MANY, 'AdViewClick', 'advertise_id','condition'=>'type=1'),	
			'advertiser' => array(self::HAS_ONE, 'Advertiser', 'advertiser_id'),
			'adPic' => array(self::HAS_MANY, 'AdvertisePic', 'ad_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'advertiser_id' => '广告主编号',
			'title' => '广告标题',
			'content' => '广告内容',
			'view' => 'View',
			'click' => 'Click',
			'direct_to' => '广告链接',
			'pay_type' => 'Pay Type',
			'cpm' => 'Cpm',
			'cpc' => '扣费额度',
			'priority' => '广告优先级',
			'community'=>'小区'
		);
	}

	public static function getAdvertisePriority($id){
		if(isset($id) && is_numeric($id)){
				switch ($id) {
					case 0:
						$priorityName = "低";
						break;
					
					case 1:
						$priorityName = "中";
						break;

					case 2:
						$priorityName = "高";
						break;

					case 3:
						$priorityName = "非常高";
						break;

					default:
						$priorityName = "未设定";
						break;
				}
				return $priorityName;
		}		
			
	}
	/*
	**获取投放小区对应的地域
	*/
	public static function getLocation(){
		$area = Area::model()->findAll('fid =:id',array(':id'=>2449));
		$areaData = array();
		$areaData = CHtml::listData($area,'id','area_name');
		return $areaData;
	}

	
	/*
	**获取该地域内的所有小区
	*/
	public static function getCommunity($location){
		$communityData= array();
		if(!empty($location) && is_numeric($location)){
			$community = Community::model()->findAll('location =:location',array(':location'=>$location));
			if(!empty($community)){
				$communityData = CHtml::listData($community,'id','community_name');
				return $communityData;
			}
			
		}else {
			return $communityData;
		}
	}

	/*
	**获取投放小区名称
	*/
	public static function getCommunityName($communityId){
		if(isset($communityId) && is_numeric($communityId)){
			$community = Community::model()->findAll('id =:id',array(':id'=>$communityId));
			if(!empty($community)){
				$communityName = $community[0]->community_name;
				return $communityName;
			}
		}else
			return "全部小区";
	}


	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('advertiser_id',$this->advertiser_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('view',$this->view);
		$criteria->compare('click',$this->click);
		$criteria->compare('direct_to',$this->direct_to,true);
		$criteria->compare('pay_type',$this->pay_type);
		$criteria->compare('cpm',$this->cpm);
		$criteria->compare('cpc',$this->cpc);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('community',$this->community,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Advertise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
