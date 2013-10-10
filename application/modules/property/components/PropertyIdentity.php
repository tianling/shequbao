<?php
/**
 * @name PropertyIdentity.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class PropertyIdentity extends CUserIdentity{
	public $id;
	public function authenticate(){
		$condition = '`phone`=:account OR `email`=:account';
		$user = PropertyAdmin::model()->with('baseUser')->find($condition,array(':account'=>$this->username));
		
		if ( $user === null ){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			$this->errorMessage = '用户不存在';
			return false;
		}
	
		$security = Yii::app()->getSecurityManager();
		if ( $security->verify($this->password,$user->getAttribute('password')) ){
			$states = array('property_id','realname','email','last_login_time','last_login_ip');
				
			$this->setPersistentStates($user->getAttributes($states));
			$this->username = $user->getAttribute('nickname');
			$this->id = $user->getAttribute('id');
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