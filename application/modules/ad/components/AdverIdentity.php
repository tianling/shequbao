<?php
/**
 * @name AdverIdentity.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-15
 * Encoding UTF-8
 */
class AdverIdentity extends CUserIdentity{
	public $id;
	public function authenticate(){
		$condition = '`phone`=:account OR `email`=:account';
		$user = Advertiser::model()->with('baseUser')->find($condition,array(':account'=>$this->username));
		
		if ( $user === null ){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			$this->errorMessage = '广告主不存在';
			return false;
		}
	
		$security = Yii::app()->getSecurityManager();
		if ( $security->verify($this->password,$user->getAttribute('password')) ){
			$states = array('balance','phone','email','last_login_time','last_login_ip');
				
			$this->setPersistentStates($user->getAttributes($states));
			$this->username = $user->getAttribute('nickname');
			$this->id = $user->getAttribute('advertiser_id');
			$this->errorCode = self::ERROR_NONE;
			return true;
		}else {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			$this->errorMessage = '密码错误';
			return false;
		}
	}
	
	public function getId(){
		return $this->id;
	}
}