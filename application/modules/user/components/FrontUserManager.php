<?php
/**
 * @name FrontUserManager.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-18
 * Encoding UTF-8
 */
class FrontUserManager extends BaseUserManager{
	public function init(){
		Yii::import('user.models.*');
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
			else
				return 400;
		}
	}

	public function getCloseUser($lat,$lng){
		if(!empty($lat) && !empty($lng) && is_numeric($lat) && is_numeric($lng)){
			$criteria= new CDbCriteria;
			$criteria->select = 'coord_x,coord_y,time,uid';
			$time = time();
			$criteria->condition = 'time - "'.$time.'" <= 432000'; 
			$UserData = CloseUser::model()->findAll($criteria);

			if(!empty($UserData)){
				$closeUserData = array();
				$closeUser = array();
				foreach ($UserData as $key => $value){
					$closeUserData[$key]['data'] = $value->getAttributes();
					$lat2 = $closeUserData[$key]['data']['coord_x'];
					$lng2 = $closeUserData[$key]['data']['coord_y'];
					$distance = $this->GetDistance($lat,$lng,$lat2,$lng2);

					if($distance<=1)
						$closeUser[$key]['data']['id'] = $closeUserData[$key]['data']['uid'];
						$uid = $closeUser[$key]['data']['id'];
						$criteria= new CDbCriteria;
						$criteria->alias = 'user';
						$criteria->select = 'nickname';
						$criteria->condition = 'user.id = "'.$uid.'" ';
						$criteria->with = array(
											'frontUser'=>array(
													'select'=>'icon',
												),/*'trends'=>array(
													'select'=>'content',
													'order'=>'publish_time',
													'limit'=>1,
													'offset'=>0,
												),*/
											
											
							);
						$userData = UserModel::model()->findAll($criteria);
						$userIcon = $userData[0]->getRelated('frontUser');
						$Icon = $userIcon->getAttributes();
						$IconName =$Icon['icon'];
						echo $IconName;
						die();

				}
				
				if(!empty($closeUser))
					return $closeUser;					
				else
					return 300;
			}
		}
				
	}

	public 	function GetDistance($lat1, $lng1, $lat2, $lng2)  
	{  
	    $EARTH_RADIUS = 6378.137;  
	    $radLat1 = deg2rad($lat1);  
	    //echo $radLat1;  
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
}