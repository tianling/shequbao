<?php
/**
 * @name ServiceController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-31
 * Encoding UTF-8
 */
class ServiceController extends CmsController{
	
	public $actionClassPathAlias = 'application.modules.user.controllers';
	
	public function init(){
		parent::init();
		$this->getModule()->configureUser();
	}
	
	public function filters(){
		$filters = parent::filters();
		$filters['hasLogined'][0] = $filters['hasLogined'][0].' - create,login,verificationCode,resetPassword';
		unset($filters['accessControl']);
		return $filters;
	}
	
	public function getActionClass(){
		return array(
				'create' => array('class' => 'createUser'),
				'createAddress' => array('class' => 'createUserAddress'),
				'createFamilyMember',
				'createFamilyConfirm' => array('class'=>'familyConfirm'),
				'createMyContacts',
				'verificationCode',
				'resetPassword',
				
				'update' => array('class' => 'updateUser'),
				'updateAddress' => array('class' => 'updateUserAddress'),
				
				'getAddress' => array('class' => 'getUserAddress'),
				'getBind' => array('class' => 'getUserBindInfo'),
				'getCommunity',
				'getFamilyInvitation',
				'getMyContacts',
				
		);
	}
	
	public function actionLogin(){
		if ( $this->app->getUser()->getIsGuest() ){
			$model = new SqbLoginForm('app');
			$model->attributes = $this->getRestParam();
			
			if ( $model->login(3600*24*30) ){
				$this->response(100,'登录成功',$model->getIdentity()->getReturnStates());
			}else {
				$this->response(102,'登录失败',$model->getErrors());
			}
		}else {
			$this->response(103,'请不要重复登录');
		}
	}
	
	public function actionLogout(){
		$this->app->getUser()->logout();
		$this->response(101,'退出成功');
	}
	
	public function loginRequired(){
		$this->response(400,'请登录');
	}

	public function actionGetCloseUser($uid,$lag,$lng){ //获取附近用户
		if(!empty($uid) && !empty($lag) && !empty($lng)){
			$userPlaceclean = $this->app->UserManager->cleanMyplace($uid);
			if($userPlaceclean == 200){
				$userAdd = $this->app->UserManager->addCloseUser($uid,$lag,$lng);
				if($userAdd == 200){
					$closeUserData = $this->app->UserManager->getCloseUser($lag,$lng,$uid);
					if($closeUserData == 300)
						$this->response(300,'','附近无用户');
					else
						$this->response(200,'',$closeUserData);
				}
				
				else
					$this->response(400,'',$userAdd);
			}

			elseif($userPlaceclean == 300){
				$userAdd = $this->app->UserManager->addCloseUser($uid,$lag,$lng);
				if($userAdd == 200){
					$closeUserData = $this->app->UserManager->getCloseUser($lag,$lng,$uid);
					if($closeUserData == 300)
						$this->response(300,'','附近无用户');
					else
						$this->response(200,'',$closeUserData);
				}
				
				else
					$this->response(400,'',$userAdd);
			}	
		}else
			$this->response(101,'','无参数');		
	}

	public function actionCleanMyplace($uid){ //清除用户位置信息
		if(!empty($uid) && is_numeric($uid)){
			$cleanUserPleace = $this->app->UserManager->cleanMyplace($uid);
			if($cleanUserPleace == 200)
				$this->response(200,'','删除成功');
			else if($cleanUserPleace == 300)
				$this->response(300,'','该用户无位置信息');
			else
				$this->response(400,'','发生错误');
		}
	}

	public function actionCreateMessage($resourceId){
		$content = $this->getPost('content',null);
		if( $content !== null ){
			$messageAdd = $this->app->UserManager->messageAdd($resourceId,$content);
			if( $messageAdd->hasErrors() === false )
				$this->response(200,'反馈添加成功');
			else
				$this->response(201,'发生错误',$messageAdd->getErrors());
		}else {
			$this->response(201);
		}
	}

	public function actionGetChargeinfo($uid){
		if(!empty($uid) && is_numeric($uid)){
			$addressData = $this->app->UserManager->getAddressinfo($uid);
			$chargeInfo = array();
			$waterFee = 0;
			$gasFee = 0;
			$electricityFee = 0;
			$garbageFee = 0;
			$manageFee = 0;
			$otherFee = 0;

			if(!empty($addressData)){

				$chargeData = UserChargeInfo::model()->findAll('uid=:uid',array(':uid'=>$uid));

				if(!empty($chargeData)){
					
					foreach($chargeData as $key =>$value){	
						if($value->type == 0)
							$waterFee+=$value->charge;	
						elseif($value->type == 1)
							$electricityFee+=$value->charge;
						elseif($value->type == 2)
							$gasFee+=$value->charge;
						elseif($value->type == 3)
							$garbageFee+=$value->charge;
						elseif($value->type == 4)
							$manageFee+=$value->charge;
						elseif($value->type == 5)
							$otherFee+=$value->charge;

					}

					if($waterFee == 0 && $electricityFee == 0 && $gasFee == 0 && $garbageFee == 0){
							$userData = array();
							$chargeData = array();

							foreach($addressData as $key =>$value){
								$roomId = $value->id;
 								$waterNumber = $value->water;
								$electricityNumber = $value->electricity;
								$gasNumber = $value->gas;
								$garbageNumber = $value->garbage;
								$watercharge = $this->app->UserManager->getChargeinfo($waterNumber,0);
								$electricitycharge = $this->app->UserManager->getChargeinfo($gasNumber,1);
								$gascharge = $this->app->UserManager->getChargeinfo($gasNumber,2);
								$garbagecharge = $this->app->UserManager->getChargeinfo($gasNumber,3);

								if(!empty($watercharge) && is_object($watercharge)){
									$info = $watercharge->userInfo->items;

									foreach($info as $key =>$value){
										if($value->pay == 'false'){
											$waterFee += $value->amount;
										}
									}	
								
								}
								if(!empty($electricitycharge) && is_object($electricitycharge)){
									$info = $electricitycharge->userInfo->items;

									foreach($info as $key =>$value){
										if($value->pay == 'flase'){
											$electricityFee += $value->amount;
										}
									}
								
								}

								if(!empty($gascharge) && is_object($gascharge)){
									$info = $gascharge->userInfo->items;
									foreach($info as $key =>$value){
										if($value->pay == 'flase'){
											$gasFee += $value->amount;
										}

									}
								
								}

								if(!empty($garbagecharge) && is_object($garbagecharge)){
									$info = $garbagecharge->userInfo->items;
									foreach($info as $key =>$value){
										if($value->pay == 'flase'){
											$garbageFee += $value->amount;
										}

									}
								
								}
							}

					}
					$chargeInfo = array(
							'waterFee' =>$waterFee,
							'electricityFee'=>$electricityFee,
							'gasFee'=>$gasFee,
							'garbageFee'=>$garbageFee,
							'manageFee'=>$manageFee,
							'otherFee'=>$otherFee,

						);

					$this->response('200','',$chargeInfo);

				}else{

						foreach($addressData as $key =>$value){
							$roomId = $value->id;
 							$waterNumber = $value->water;
							$electricityNumber = $value->electricity;
							$gasNumber = $value->gas;
							$garbageNumber = $value->garbage;
							$watercharge = $this->app->UserManager->getChargeinfo($waterNumber,0);
							$electricitycharge = $this->app->UserManager->getChargeinfo($gasNumber,1);
							$gascharge = $this->app->UserManager->getChargeinfo($gasNumber,2);
							$garbagecharge = $this->app->UserManager->getChargeinfo($gasNumber,3);

							if(!empty($watercharge) && is_object($watercharge)){
								$info = $watercharge->userInfo->items;

								foreach($info as $key =>$value){
									if($value->pay == 'false'){
										$waterFee += $value->amount;
									}
								}	
								
							}
							if(!empty($electricitycharge) && is_object($electricitycharge)){
								$info = $electricitycharge->userInfo->items;

								foreach($info as $key =>$value){
									if($value->pay == 'flase'){
										$electricityFee += $value->amount;
									}
								}
								
							}

							if(!empty($gascharge) && is_object($gascharge)){
								$info = $gascharge->userInfo->items;
								foreach($info as $key =>$value){
									if($value->pay == 'flase'){
										$gasFee += $value->amount;
									}

								}
								

							}

							if(!empty($garbagecharge) && is_object($garbagecharge)){
								$info = $gascharge->userInfo->items;
								foreach($info as $key =>$value){
									if($value->pay == 'flase'){
										$garbageFee += $value->amount;
									}

								}
								
							}
							
							
							//var_dump($watercharge['userInfo']['items'][0]['amount']);
							$chargeInfo = array(
							'waterFee' =>$waterFee,
							'electricityFee'=>$electricityFee,
							'gasFee'=>$gasFee,
							'garbageFee'=>$garbageFee,
							'manageFee'=>$manageFee,
							'otherFee'=>$otherFee,

						);

						}

						$this->response('200','',$chargeInfo);
				}
					
				

			}else{
				$this->response('400','','该用户无房产');
				}
		}
	}


}