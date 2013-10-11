<?php
/**
 * @name FrontUserManager.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-18
 * Encoding UTF-8
 */
class FrontUserManager extends BaseUserManager{

	private $charge_url = "http://service.jiaofei123.com/service/scan-info.json";
	private $loginName = "qin_huang_sj_client";
	private $sec_key = "NF/f@DL[skCE /nYdD^q?j-<j$`N6}~_";

	private $cityId = '023';
	private $waterType = 4;
	private $gasType = 6;
	private $electricityType = 5;
	private $garbageType = 7;

	private $waterProviders = array(
		20,
		4,
		5,
		91,
		93,
		94
	);


	private $electricityProviter = 22;
	private $gasProviders = array(
			21,
			89
		);
	

	public function init(){
		Yii::import('user.models.*');
		$this->attachBehavior('curl','CurlBehavior');
		$this->attachBehavior('curlMulti','CurlMultiBehavior');

	}
	
	public function findAll($criteria=null,$params=array()){
		return SqbUser::model()->findAll($criteria,$params);
	}
	
	public function findByPk($pk,$criteria=null,$params=array()){
		return SqbUser::model()->findByPk($pk,$criteria,$params);
	}
	
	public function count($criteria=null,$params=array()){
		return SqbUser::model()->count($criteria,$params);
	}

	public function addCloseUser($uid,$lat,$lng){
		if(!empty($uid) && !empty($lat) && !empty($lng) ){

			$CloseUserModel = new CloseUser;
			$CloseUserModel->coord_x = $lat;
			$CloseUserModel->coord_y = $lng;
			$CloseUserModel->uid = $uid;
			$CloseUserModel->time = time();

			if($CloseUserModel->save())
				return 200;
			else{
				$error = var_dump($model->getErrors());
				return $error;
				
			}
				
		}
	}

	public function getCloseUser($lat,$lng,$uid){ //获取附近用户并且存储用户位置信息
		if(!empty($lat) && !empty($lng)  && is_numeric($uid)){
			$user_id = $uid;
			$criteria= new CDbCriteria;
			$criteria->select = 'coord_x,coord_y,time,uid';
			$time = time();
			$criteria->condition = 'time - "'.$time.'" <= 432000 AND uid != "'.$user_id.'"'; 
			$UserData = CloseUser::model()->findAll($criteria);
			
			if(!empty($UserData)){
				$closeUserData = array();
				$closeUser = array();

				foreach ($UserData as $key => $value){
					$closeUserData[$key]['data'] = $value->getAttributes();
					
					$lat2 = $closeUserData[$key]['data']['coord_x'];
					$lng2 = $closeUserData[$key]['data']['coord_y'];
					$distance = $this->GetDistance($lat,$lng,$lat2,$lng2);
					if($distance<=1){

						$id = $closeUserData[$key]['data']['uid'];

						$criteria= new CDbCriteria;
						$criteria->alias = 'user';
						$criteria->select = 'nickname';
						$criteria->condition = 'user.id = "'.$id.'"';
						$criteria->with = array(
													'frontUser'=>array(
																'select'=>'icon',
																),
													'trends'=>array(
																'select'=>'content',
																'order'=>'publish_time DESC',
																'limit'=>1,
																'offset'=>0,
																),
																
																
												);
						$userData = UserModel::model()->findAll($criteria);
						$username = $userData[0]['nickname'];
						
						if(!empty($userData[0]->frontUser) ){
							$userIcon = $userData[0]->getRelated('frontUser');
							$Icon = $userIcon->getAttributes();
							$IconName =$Icon['icon'];
							
							if(!empty($userData[0]->trends)){
								$usertrends = $userData[0]->getRelated('trends');
								$trendsData = $usertrends[0]['content'];
								$closeUser[] = array(
									'id' => $id,
									'nickname' => $username,
									'icon'=>$IconName,
									'trends'=>$trendsData,
									);
							}else{
								$closeUser[] = array(
									'id' => $id,
									'nickname' => $username,
									'icon'=>$IconName,
									);
							}
												

						}
						
					}
					
						
				}
				
				if(!empty($closeUser))
					return $closeUser;					
				else
					return 300;
			}else
				return 300;
		}
				
	}

	public function getAddressinfo($uid){
		if(!empty($uid) && is_numeric($uid)){
			$addressInfo = UserAddress::model()->findAll('user_id =:uid',array(':uid'=>$uid));
			if(!empty($addressInfo)){
				return $addressInfo;
			}
		}
	}

	public function getChargeinfo($number,$type){
		if(!empty($number) && is_numeric($type)){
			
			$waterFee = 0;
			$electricityFee = 0;
			$gasFee = 0;
			$garbageFee = 0;
			switch ($type) {
				case 0:
					
					$curl = $this->curl;
					$curlMulti = $this->curlMulti;
					$curlMulti->setMaxConnections(50);
					$handlers = array();

					foreach ( $this->waterProviders as $provider ){
						$key = md5("loginName=".$this->loginName."&cityCode=".$this->cityId."&typeCode=".$this->waterType
								."&providerId=".$provider."&number=".$number."&key=".$this->sec_key."");
						$data = array(
							'loginName' =>$this->loginName,
							'cityCode' =>$this->cityId,
							'typeCode' =>$this->waterType,
							'providerId'=>$provider,
							'number'=>$number,
							'key'=>$key
						);

						$handlers[] = $curl->getCurlHandler(true);
						$curl->setUrl($this->charge_url);
						$curl->setReturn(true);
						$curl->setMethod('POST');
						$curl->setRequestBody($data);
						$curl->curlBuildOpts();
					}

					$curlMulti->addHandlersToMultiHandler($handlers);
					$result = $curlMulti->exec();
					$a = $curlMulti->getReadableHandlers();
					foreach ( $a as $c ){
						$chargeData = json_decode($curlMulti->getContent($c),true);
						if($chargeData !==null && isset($chargeData['userInfo'])){
							if($chargeData['userInfo']['items'] !==null){
								foreach($chargeData['userInfo']['items'] as $key=>$value){
									if($value['pay'] == false){
										$waterFee += $$value['amount'];
									}
								}	
							}
						}
						
						
					}

					return $waterFee;
					break;

				case 1:
					$key = md5("loginName=".$this->loginName."&cityCode=".$this->cityId."&typeCode=".$this->electricityType."&providerId=".$this->electricityProviter."&number=".$number."&key=".$this->sec_key."");
					$data = array(
							'loginName' =>$this->loginName,
							'cityCode' =>$this->cityId,
							'typeCode' =>$this->electricityType,
							'providerId'=>$this->electricityProviter,
							'number'=>$number,
							'key'=>$key
							
						);
				

					$output = $this->Curlget($this->charge_url,$data);
					$elecData = json_decode($output);
					if(isset($elecData->userInfo)){
						if($elecData->userInfo->items!==null){
							$info = $elecData->userInfo->items;
							foreach($info as $key =>$value){
								if($value->pay == false){
									$electricityFee += $$value->amount;
								}
							}
						}

					}
					
					return $electricityFee;
					break;

				case 2:
					$curl = $this->curl;
					$curlMulti = $this->curlMulti;
					$curlMulti->setMaxConnections(50);
					$handlers = array();

					foreach ( $this->gasProviders as $provider ){

						$key = md5("loginName=".$this->loginName."&cityCode=".$this->cityId."&typeCode=".$this->gasType.
							"&providerId=".$provider."&number=".$number."&key=".$this->sec_key."");
						$data = array(
								'loginName' =>$this->loginName,
								'cityCode' =>$this->cityId,
								'typeCode' =>$this->gasType,
								'providerId'=>$provider,
								'number'=>$number,
								'key'=>$key,
							
							);
						$handlers[] = $curl->getCurlHandler(true);
						$curl->setUrl($this->charge_url);
						$curl->setReturn(true);
						$curl->setMethod('POST');
						$curl->setRequestBody($data);
						$curl->curlBuildOpts();
					}
					$curlMulti->addHandlersToMultiHandler($handlers);
					$result = $curlMulti->exec();
					$a = $curlMulti->getReadableHandlers();

					foreach($a as $c){
						$chargeData = json_decode($curlMulti->getContent($c),true);
						if(!empty($chargeData) && isset($chargeData['userInfo'])){
							if($chargeData['userInfo']['items'] !== null){
								$info = $chargeData['userInfo']['items'];
								foreach($info as $value){
									if($value->pay == false){
										$gasFee += $value['amounts']; 
									}
								
								}
							}
						}
						

					}
			
					return $gasFee;
					break;
				
				case 3:

					$curl = $this->curl;
					$curlMulti = $this->curlMulti;
					$curlMulti->setMaxConnections(50);
					$handlers = array();

					foreach ( $this->gasProviders as $provider ){
						$key = md5("loginName=".$this->loginName."&cityCode=".$this->cityId."&typeCode=".$this->garbageType
							."&providerId=".$provider."&number=".$number."&key=".$this->sec_key."");
						$data = array(
								'loginName' =>$this->loginName,
								'cityCode' =>$this->cityId,
								'typeCode' =>$this->garbageType,
								'providerId'=>$provider,
								'number'=>$number,
								'key'=>$key,
							);
						$handlers[] = $curl->getCurlHandler(true);
						$curl->setUrl($this->charge_url);
						$curl->setReturn(true);
						$curl->setMethod('POST');
						$curl->setRequestBody($data);
						$curl->curlBuildOpts();
					}
					$curlMulti->addHandlersToMultiHandler($handlers);
					$result = $curlMulti->exec();
					$a = $curlMulti->getReadableHandlers();
					foreach($a as $c){
						
						$chargeData = json_decode($curlMulti->getContent($c),true);
						if(!empty($chargeData) && isset($chargeData['userInfo'])){
							if($chargeData['userInfo']['items'] !== null){
								$info = $chargeData['userInfo']['items'];
								foreach($info as $value){
									if($value->pay == false){
										$garbageFee += $value['amounts']; 
									}
								
								}
							}
						}
						

					}
					
					return $garbageFee;
					break;
			}
			
				
		}
	}

	public function cleanMyplace($uid){
		if(!empty($uid) && is_numeric($uid)){
			$userPleaceModel = CloseUser::model()->findAll('uid=:id',array('id'=>$uid));
			
			if(!empty($userPleaceModel)){
				$clear = CloseUser::model()->deleteAll('uid=:id',array('id'=>$uid));
				if($clear>0)
					return 200;
				else 
					return 400;				
			}
			else
				return 300;
		}
	}

	public function messageAdd($uid,$content){  //用户反馈添加
		if(!empty($uid) && !empty($content) && is_numeric($uid)){
			$messageModel = new MessageBoard();
			$messageModel ->uid = $uid;
			$messageModel ->content = $content;
			$messageModel ->add_time = time();
			$messageModel ->add_ip = Yii::app()->request->userHostAddress;

			$messageModel ->save();
			return $messageModel;
		}
	}


	public 	function GetDistance($lat1, $lng1, $lat2, $lng2)  
	{  
	    $EARTH_RADIUS = 6378.137;  
	    $radLat1 = deg2rad($lat1);   
	    $radLat2 = deg2rad($lat2);  
	    $a = $radLat1 - $radLat2;  
	    $b = deg2rad($lng1) - deg2rad($lng2);  
	    $s = 2 * asin(sqrt(pow(sin($a/2),2) +  
	    cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));  
	    $s = $s *$EARTH_RADIUS;  
	    $s = round($s * 10000) / 10000;  
	    return $s;  
	}  

	/**
	 * 
	 * @param unknown $attributes
	 * @return SqbUser
	 */
	public function addAppUser($attributes){
		$user = new SqbUser('appReg');
		
		$attributes['icon'] = mt_rand(1,24);
		$attributes['last_login_time'] = time();
		$user->attributes = $attributes;
		
		$user->save();
		return $user;
	}

	public function Curlget($url,$data){
		if(!empty($url) && !empty($data)){
			$url =	$url;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST,1); 
			$data = http_build_query($data);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
			ob_start();  
			curl_exec($ch);  
			$result = ob_get_contents() ;  
			ob_end_clean();
			curl_close($ch) ;   
			return $result;    
			 
		}
	}

	
}