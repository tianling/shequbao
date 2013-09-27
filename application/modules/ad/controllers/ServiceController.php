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
	

	public function actionGetAd(){ //随机获取广告
		$adData = $this->app->AdManager->adGetRandom();
		if(!empty($adData)){
			$this->response(200,'',$adData);
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