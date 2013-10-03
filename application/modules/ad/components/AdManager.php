<?php
/**
 * @name AdManager.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-11
 * Encoding UTF-8
 */
class AdManager extends CApplicationComponent{
	
	/**
	 * 发布广告
	 */
	public function adPublish(){
		
	}
	
	/**
	 * 随机获取广告
	 */
	public function adGetRandom(){
		$criteria= new CDbCriteria;
		$criteria->select = 'advertiser_id,balance,phone';
		$criteria->condition = 'balance>0 AND ads>0';
		$count = Advertiser::model()->count($criteria);
		$top = rand(0,$count-1);
		$criteria->limit = 1;
		$criteria->offset = $top;
		$advertiserData = Advertiser::model()->findAll($criteria);
		$advertiser_id = $advertiserData[0]['advertiser_id'];
		//从该用户发布的广告中随机选取一部分照片，然后按照曝光次数和优先级推送一条
		$criteria = new CDbCriteria;
		$criteria->select = 'id,advertiser_id,title,content,view,direct_to,priority';
		$criteria->condition = 'advertiser_id = "'.$advertiser_id.'" ';
		$adCount = Advertise::model()->count($criteria);
		$top = rand(0,$count-4);
		$criteria->limit = 4;
		$criteria->offset = $top;
		$criteria->order = 'view,priority DESC';
		$advertiseData = Advertise::model()->findAll($criteria);
		if(!empty($advertiseData)){
			$adData = array();
			$adData = $advertiseData[0]->getAttributes();
			$adId = $adData['id'];
			$adPic = AdvertisePic::model()->findAll('ad_id=:adId',array(':adId'=>$adId));
			if(!empty($adPic)){
				$picData = $adPic[0]->getAttributes();
				$adData['adPic'] = $picData['thumb_url'];
				$adView = Advertise::model()->findByPk($advertiseData[0]['id']);
				$view = $adView->view +1;
				$adView->view = $view;
				$adView->save();
				$putData = $adData;
				return $putData;
			}else{
				$adData['adPic'] = " ";
				$adView = Advertise::model()->findByPk($advertiseData[0]['id']);
				$view = $adView->view +1;
				$adView->view = $view;
				$adView->save();
				$putData = $adData;
				return $putData;
			}
			
		}		
	}
	
	/**
	 * 在获取成功之后，客户端发送标识，调用
	 */
	public function adViewed($id,$user_id){
		if(isset($id) && is_numeric($id) && isset($user_id) && is_numeric($user_id)){
			$model = new AdViewClick;
			$Admodel = Advertise::model()->findByPk($id);
			$model->user_id = $user_id;
			$model->advertise_id = $Admodel->id;
			$model->type = 0;
			$model->time = time();
			$model->cost = $Admodel->cpc;
			if($model->save())
				return 200;
			else
				$error = var_dump($model->getErrors());
				return $error;
			
		}
		
	}
	
	/**
	 * 点击广告时回调
	 */
	public function adClick($id,$user_id){
		if(isset($id) && is_numeric($id) && isset($user_id) && is_numeric($user_id)){
			$model = new AdViewClick;
			$Admodel = Advertise::model()->findByPk($id);
			if(!empty($Admodel)){
				$model->user_id = $user_id;
				$model->advertise_id = $Admodel->id;
				$model->type = 1;
				$model->time = time();
				$model->cost = $Admodel->cpc;
				if($model->save())
					return 200;
				else{
					$error = var_dump($model->getErrors());
					return $error;
				}
			
			}
		}		
	}
	
	/**
	 * 广告主扣费
	 */
	public function adVerCost($resourceId,$id){
		if(!empty($resourceId) && is_numeric($id) && !empty($id) &&is_numeric($resourceId)){
			$advertiseModel = Advertise::model()->findByPk($resourceId);

			$advertiserModel = Advertiser::model()->findByPk($id);
			if(!empty($advertiserModel) && !empty($advertiseModel)){
				$balance = $advertiserModel->balance;
				$cpc = $advertiseModel->cpc;
				$advertiserModel->balance = $balance - $cpc;
				if($advertiserModel->save())
					return 200;
						
				else{
					return 400;

				}
			}
			
				

			$advertiserModel = Advertiser::model()->with('baseUser')->findByPk($id);
			
			$balance = $advertiserModel->getAttribute('balance');
			$cpc = $advertiseModel->cpc;
			$advertiserModel->setAttribute('balance',$balance - $cpc);
			if($advertiserModel->save()){
				return 200;
			}else{
				var_dump($advertiserModel->getErrors());die;
				return 400;
			}

		}
	}	

	
	
	
	/**
	 * 广告主充值
	 */
	public function adVerRecharge(){
		
	}
	
	/**
	 * 添加广告主
	 */
	public function addAdVer($data){
		
	}
	
	/**
	 * 移除广告主
	 */
	public function removeAdVer($a){
		
	}
}