<?php
/**
 * @name FrontUserManager.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-18
 * Encoding UTF-8
 */
class FrontUserManager extends BaseUserManager{

	private $charge_url = "http://test.jiaofei123.com/service/scan-info.json";
	private $loginName = "test";
	private $sec_key = "testKey";

	private $cityId = 2;
	private $waterType = 5;
	private $gasType = 6;
	private $electricityType = 7;
	private $garbageType = 8;

	private $waterProviter1 = 3;
	private $waterProviter2 = 4;
	private $waterProviter3 = 5;
	private $waterProviter4 = 91;
	private $waterProviter5 = 93;
	private $waterProviter6 = 94;

	private $electricityProviter = 6;
	private $gasProviter1 = 2;
	private $gasProviter2 = 89;

	public function init(){
		Yii::import('user.models.*');
		$this->attachBehavior('curl','CurlBehavior');
		//$this->attachBehavior('curlMulti','CurlMultiBehavior');

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
			//echo $CloseUserModel->coord_y;
			//die();
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

			switch ($type) {
				case 0:
					$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->waterType."&providerId=".$this->waterProviter1."&number=".$number."&key=".$this->sec_key."");
					$data = array(
							'loginName' =>$this->loginName,
							'cityId' =>$this->cityId,
							'typeId' =>$this->waterType,
							'providerId'=>$this->waterProviter1,
							'number'=>$number,
							'key'=>$key
							
						);
				

					$output = $this->Curlget($this->charge_url,$data);
					$chargeData = json_decode($output);

					if($chargeData->state == 2){
						$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->waterType."&providerId=".$this->waterProviter2."&number=".$number."&key=".$this->sec_key."");
						$data = array(
								'loginName' =>$this->loginName,
								'cityId' =>$this->cityId,
								'typeId' =>$this->waterType,
								'providerId'=>$this->waterProviter2,
								'number'=>$number,
								'key'=>$key
							
							);
				

						$output = $this->Curlget($this->charge_url,$data);
						$chargeData = json_decode($output);
						if($chargeData->state == 2){
							$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->waterType."&providerId=".$this->waterProviter3."&number=".$number."&key=".$this->sec_key."");
							$data = array(
									'loginName' =>$this->loginName,
									'cityId' =>$this->cityId,
									'typeId' =>$this->waterType,
									'providerId'=>$this->waterProviter3,
									'number'=>$number,
									'key'=>$key
							
								);
				

							$output = $this->Curlget($this->charge_url,$data);
							$chargeData = json_decode($output);
							if($chargeData->state == 2){
								$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->waterType."&providerId=".$this->waterProviter4."&number=".$number."&key=".$this->sec_key."");
								$data = array(
										'loginName' =>$this->loginName,
										'cityId' =>$this->cityId,
										'typeId' =>$this->waterType,
										'providerId'=>$this->$waterProviter4,
										'number'=>$number,
										'key'=>$key
							
									);
				

								$output = $this->Curlget($this->charge_url,$data);
								$chargeData = json_decode($output);
								if($chargeData->state == 2){
									$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->waterType."&providerId=".$this->waterProviter5."&number=".$number."&key=".$this->sec_key."");
									$data = array(
											'loginName' =>$this->loginName,
											'cityId' =>$this->cityId,
											'typeId' =>$this->waterType,
											'providerId'=>$this->$waterProviter5,
											'number'=>$number,
											'key'=>$key
							
										);
				

									$output = $this->Curlget($this->charge_url,$data);
									$chargeData = json_decode($output);
									if($chargeData->state == 2){
										$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->waterType."&providerId=".$this->waterProviter6."&number=".$number."&key=".$this->sec_key."");
										$data = array(
												'loginName' =>$this->loginName,
												'cityId' =>$this->cityId,
												'typeId' =>$this->waterType,
												'providerId'=>$this->$waterProviter6,
												'number'=>$number,
												'key'=>$key,
							
											);
				

										$output = $this->Curlget($this->charge_url,$data);
										$chargeData = json_decode($output);
										if($chargeData->state == 1){
											var_dump($chargeData);
											die();
										}
											
										elseif($chargeData->state == 2) 
											return 401;
										else
											return 400;

									}else if($chargeData->state == 1)
										return $chargeData;
									else 
										return 400;
								}else if($chargeData->state == 1)
									return $chargeData;
								else
									return 400;
							}else if($chargeData->state == 1)
								return $chargeData;
							else
								return 400;				
						}else if($chargeData->state == 1)
							return $chargeData;
						else
							return 400;
					}
					else if($chargeData->state == 1){
						//$chargeData = 400;
						return $chargeData;
					}
						
					else
						return 400;
					
					break;

				case 1:
					$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->electricityType."&providerId=".$this->electricityProviter."&number=".$number."&key=".$this->sec_key."");
					$data = array(
							'loginName' =>$this->loginName,
							'cityId' =>$this->cityId,
							'typeId' =>$this->electricityType,
							'providerId'=>$this->electricityProviter,
							'number'=>$number,
							'key'=>$key
							
						);
				

					$output = $this->Curlget($this->charge_url,$data);
					$chargeData = json_decode($output);
					if($chargeData->state == 1){
						return $chargeData;
					}elseif ($chargeData->state == 2) {
						return 401;
					}else
						return 400;

					break;

				case 2:
					$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->gasType."&providerId=".$this->gasProviter1."&number=".$number."&key=".$this->sec_key."");
					$data = array(
							'loginName' =>$this->loginName,
							'cityId' =>$this->cityId,
							'typeId' =>$this->gasType,
							'providerId'=>$this->gasProviter1,
							'number'=>$number,
							'key'=>$key,
							
						);
				
					$output = $this->Curlget($this->charge_url,$data);
					$chargeData = json_decode($output);
					if($chargeData->state == 2){
						$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->gasType."&providerId=".$this->gasProviter2."&number=".$number."&key=".$this->sec_key."");
						$data = array(
								'loginName' =>$this->loginName,
								'cityId' =>$this->cityId,
								'typeId' =>$this->gasType,
								'providerId'=>$this->gasProviter2,
								'number'=>$number,
								'key'=>$key,
							
							);
				
						$output = $this->Curlget($this->charge_url,$data);
						$chargeData = json_decode($output);
						if($chargeData->state == 1)
							return $chargeData;
						elseif($chargeData->state == 2)
							return 401;
						else
							return 400;
					}elseif($chargeData->state == 1)	
						return $chargeData;
					else
						return 400;

					break;

				case 3:
					$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->garbageType."&providerId=".$this->gasProviter1."&number=".$number."&key=".$this->sec_key."");
					$data = array(
							'loginName' =>$this->loginName,
							'cityId' =>$this->cityId,
							'typeId' =>$this->garbageType,
							'providerId'=>$this->gasProviter1,
							'number'=>$number,
							'key'=>$key,
						);
					$output = $this->Curlget($this->charge_url,$data);
					$chargeData = json_decode($output);
					if($chargeData->state == 2){
						$key = md5("loginName=".$this->loginName."&cityId=".$this->cityId."&typeId=".$this->gasType."&providerId=".$this->gasProviter2."&number=".$number."&key=".$this->sec_key."");
						$data = array(
								'loginName' =>$this->loginName,
								'cityId' =>$this->cityId,
								'typeId' =>$this->gasType,
								'providerId'=>$this->gasProviter2,
								'number'=>$number,
								'key'=>$key,
							
							);
				
						$output = $this->Curlget($this->charge_url,$data);
						$chargeData = json_decode($output);
						if($chargeData->state == 1)
							return $chargeData;
						elseif($chargeData->state == 2)
							return 401;
						else
							return 400;
					}elseif($chargeData->state == 1)
						return $chargeData;
					else
						return 400;

					break;

				default:
						return 402;
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
			$messageModel = new MessageBoard;
			$messageModel ->uid = $uid;
			$messageModel ->content = $content;
			$messageModel ->add_time = time();
			$messageModel ->add_ip = Yii::app()->request->userHostAddress;

			if($messageModel ->save())
				return 200;
			else
				return 400;
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
		
		$attributes['icon'] = mt_rand(1,5);
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