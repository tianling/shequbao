<?php
/**
 * @name ServiceController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-11
 * Encoding UTF-8
 */
class ServiceController extends CmsController{
	public function filters(){
		return array();
	}
	
	/*
	**随机获取广告
	*/
	public function actionGetAd(){ 
		$adData = $this->app->AdManager->adGetRandom();
		if(!empty($adData)){
			$this->response(200,'',$adData);
		}

	}

	/*
	**根据用户小区定点推送广告
	*/

	public function actionGetAdWithCommunity($uid){
		if(isset($uid) && is_numeric($uid)){
			$communityData = $this->app->AdManager->getUserCommunity($uid);
			if(!is_array($communityData)){
				$adData = $this->app->AdManager->adGetRandom();
				if(!empty($adData)){
					$this->response(200,'',$adData);
				}

			}else if(!empty($communityData)){
				$adData = array();
				foreach($communityData as $value){
					$advertise = $this->app->AdManager->getAdByCommunity($value['community']);

					if(is_array($advertise) && !empty($advertise)){

						if(isset($advertise['adPic'])){
							$adData[] = array(
								'id'=>$advertise['id'],
								'advertiser_id'=>$advertise['advertiser_id'],
								'title'=>$advertise['title'],
								'content'=>$advertise['content'],
								'direct_to'=>$advertise['direct_to'],
								'adPic'=>$advertise['adPic']
							);

						}else{
							$adData[] = array(
								'id'=>$advertise['id'],
								'advertiser_id'=>$advertise['advertiser_id'],
								'title'=>$advertise['title'],
								'content'=>$advertise['content'],
								'direct_to'=>$advertise['direct_to'],
							);
						}

						
					}
					
				}
				$adNum = count($adData);
				if($adNum>0){
					$adPush = rand(0,$adNum-1);
					$advertiseData = $adData[$adPush];
					$this->response(200,'',$advertiseData);
				}else
					$this->response(400,'该小区暂无广告可以投放');
				
				
			}

		}
	}


	public function actionUpdateBalanceClick($resourceId,$id,$uid){//根据客户端返回的数据对用户进行扣费
		if(!empty($resourceId) && is_numeric($id) && !empty($uid) && is_numeric($uid)){
			$CostPay = $this->app->AdManager->adVerCost($resourceId,$id);
			$adClick = $this->app->AdManager->adClick($resourceId,$uid);
			if($CostPay == 200 && $adClick == 200)
				$this->response($CostPay,'','扣费操作成功');
			else
				$this->response($CostPay,'','发生错误');

		}
	}

	public function actionUpdateView($id,$uid){
		if(!empty($id) && is_numeric($id) && !empty($uid) && is_numeric($uid)){
			$viewInput = $this->app->AdManager->adViewed($id,$uid);
			if(!empty($viewInput)){
				if($viewInput == 200)
					$this->response($viewInput,'','扣费操作成功');
				else
					$this->response(400,'','发生错误');

			}
		}
	}
}