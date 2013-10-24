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
	 * 随机获取广告
	 */
	public function adGetRandom(){
		$criteria= new CDbCriteria;
		$criteria->select = 'advertiser_id,balance,phone,ads';
		$criteria->condition = 'balance>0 AND ads>0';
		
		$count = Advertiser::model()->count($criteria);
		$top = rand(0,$count-1);
		$criteria->limit = 1;
		$criteria->offset = $top;
		$advertiserData = Advertiser::model()->findAll($criteria);
		$advertiser_id = $advertiserData[0]['advertiser_id'];
		$advertiser_ads = $advertiserData[0]['ads'];
		//从该用户发布的广告中随机选取一部分照片，然后按照曝光次数和优先级推送一条
		$criteria = new CDbCriteria;
		$criteria->select = 'id,advertiser_id,title,content,view,direct_to,priority';
		$criteria->condition = 'advertiser_id = "'.$advertiser_id.'" ';
		$adCount = $advertiser_ads;
		$top = rand(0,$adCount-4);
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

			$advertiserModel = Advertiser::model()->with('baseUser')->findByPk($id);
			

			if(!empty($advertiserModel) && !empty($advertiseModel)){
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

	/*
	**根据用户id获取用户小区
	*/

	public function getUserCommunity($uid){
		if(isset($uid) && is_numeric($uid)){
			$userCommunity = array();
			$userAddressData = UserAddress::model()->findAll('user_id =:uid',array('uid'=>$uid));
			if(!empty($userAddressData)){
				
				foreach ($userAddressData as $key =>$value) {
					$userCommunity[] = array(
							'community'=>$userAddressData[$key]->community
						);
				}
				return $userCommunity;
			}else
				return 400;
		}
	}
	
	/*
	**根据小区推送相应广告
	*/

	public function getAdByCommunity($community){
		if(!empty($community)){
			$criteria= new CDbCriteria;
			$adsModel = Advertise::model();
			$criteria->select = 'id,advertiser_id,title,content,view,direct_to,priority,community,cpc';
			$criteria->condition = 'community = '.$community.'';
			$advertiseData = $adsModel->findAll($criteria);

			if(!empty($advertiseData)){
				$adsData = $this->getAdsOrder($advertiseData);

				if(is_object($adsData) && !empty($adsData)){
					$advertiseData = array();
					$advertiseData = $adsData->getAttributes();
					$adId = $advertiseData['id'];
					$adPic = AdvertisePic::model()->findAll('ad_id =:aid',array('aid'=>$adId));
					if(!empty($adPic)){
						$advertiseData['adPic'] = $adPic[0]->thumb_url;
					}
					return $advertiseData;
				}else
					return 400;
				

			}

		}
	}

	
	/*
	**按曝光度，竞价，优先级投放广告
	*/

	public function getAdsOrder($adsData){
		if(!empty($adsData)){
			$num = count($adsData);

			for($i = 0;$i<$num-1;$i++){
				for($m = 0;$m<$num-1;$m++){
					if($adsData[$m]->view > $adsData[$m+1]->view){
						$temp = $adsData[$m];
						$adsData[$m] = $adsData[$m+1];
						$adsData[$m+1] = $temp;

					}else if($adsData[$m]->view == $adsData[$m+1]->view){
						if($adsData[$m]->cpc < $adsData[$m+1]->cpc){
							$temp = $adsData[$m];
							$adsData[$m] = $adsData[$m+1];
							$adsData[$m+1] = $temp;

						}else if($adsData[$m]->cpc == $adsData[$m+1]->cpc){
							if($adsData[$m]->priority < $adsData[$m+1]->priority){
								$temp = $adsData[$m];
								$adsData[$m] = $adsData[$m+1];
								$adsData[$m+1] = $temp;

							}
						}
					}
				}
			}

			$balance = $this->getAdvertiserBalance($adsData[0]);

			while($balance == 400){
				
				array_splice($adsData, 0,1);
				if(empty($adsData))
					break;	
				$balance = $this->getAdvertiserBalance($adsData[0]);
			}
			
			if($balance == 200)
				return $adsData[0];
			else
				return 400;
		}
			
	}


	/*
	**判断广告主余额是否足够进行本次投放
	*/
	public function getAdvertiserBalance($adsData){
		if(!empty($adsData)){
			$advertiser = Advertiser::model()->findAll('advertiser_id =:aid',array('aid'=>$adsData->advertiser_id));
			$balance = $advertiser[0]->balance;
		
			if($balance>$adsData->cpc)
				return 200;
			else
				return 400;
			
		}else
			return 401;

	}



	
}