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
	
	public function actionGetAd(){
		//随机获取一位余额大于0且有广告投放的广告主
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
		$top = rand(0,$count-1);
		$criteria->limit = 4;
		$criteria->offset = $top;
		$criteria->order = 'view,priority DESC';
		$advertiserData = Advertise::model()->with(array('adPic'=>array(
					'select'=>'thumb_url',
				)
			))->findAll($criteria);
		if(!empty($advertiserData)){
			$view = $advertiserData[0]['view']+1;
			$adView = Advertise::model()->findByPk($advertiserData[0]['id']);
			$adView->view = $view;
			$adView->save();
			$putData = $advertiserData[0];
			$this->response(200,'',$putData->getAttributes());
		}
		
		
		





	}

	public function actionUpdateBalance($resourceId,$id){//根据客户端返回的数据对用户进行扣费
		if(!empty($resourceId) && is_numeric($id)){
			/*echo $resourceId;
			echo $id;
			die();*/
			
			$advertiseModel = Advertise::model()->findByPk($resourceId);
			$advertiserModel = Advertiser::model()->findByPk($id);
			$balance = $advertiserModel->balance;
			$cpc = $advertiseModel->cpc;
			//echo $balance;
			//echo $cpc;
			$advertiserModel->balance = $balance - $cpc;
			//var_dump($advertiserModel);
			if($advertiserModel->save())
				echo $advertiserModel->balance;
			else
				var_dump($advertiserModel->getErrors());

		}
		

	}
}