<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-2
 * Encoding GBK 
 */
class AppUserIdentity extends CUserIdentity{
	/**
	 * @var int
	 */
	const ERROR_USER_LOCKED = 3;
	/**
	 * @var SqbUser
	 */
	protected $_user;
	
	/**
	 * @return boolean
	 */
	public function authenticate(){
		if ( !$this->findUser() === true ){
			return false;
		}
		if ( $this->checkLocked() === true ){
			return false;
		}
		
		$security = Yii::app()->getSecurityManager();
		if ( $security->verify($this->password,$this->_user->getAttribute('password')) ){
			$this->setPersistentStates($this->createStates());
			$this->username = $this->_user->getAttribute('id');
			$this->errorCode = self::ERROR_NONE;
			return true;
		}else {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			$this->errorMessage = '密码错误';
			return false;
		}
	}
	
	/**
	 * @return array
	 */
	public function createStates(){
		$states = $this->_user->getAttributes();
		return array(
				'uid' => $states['id'],
				'nickname' => $states['nickname'],
				'realname' => $states['realname'],
				'uuid' => $states['uuid'],
				'gender' => $states['gender'],
				'mobile' => $states['mobile'],
				'email' => $states['email'],
				'phone' => $states['phone'],
				'groupNum' => $states['groups'],
				'attentionNum' => $states['attention'],
				'beAttentionedNum' => $states['be_attentioned'],
				'status' => $states['online_status']
		);
	}
	
	/**
	 * @return array
	 */
	public function getReturnStates(){
		$states = $this->_user->getAttributes();
		return array(
				'uid' => $states['id'],
				'nickname' => $states['nickname'],
				'realname' => $states['realname'],
				'gender' => $states['gender'],
				'mobile' => $states['mobile'],
				'email' => $states['email'],
				'phone' => $states['phone'],
				'groupNum' => $states['groups'],
				'attentionNum' => $states['attention'],
				'beAttentionedNum' => $states['be_attentioned'],
				'status' => $states['online_status']
		);
	}
	
	/**
	 * @return boolean
	 */
	protected function checkLocked(){
		if ( $this->_user->getAttribute('locked') == 1 ){
			$this->errorCode = self::ERROR_LOCKED;
			$this->errorMessage = '该帐号被锁定，请与管理员联系';
			return true;
		}else {
			return false;
		}
	}
	
	/**
	 * @return boolean
	 */
	protected function findUser(){
		$condition = '`mobile`=:account OR `email`=:account';
		$this->_user = SqbUser::model()->with('baseUser')->find($condition,array(':account'=>$this->username));
		
		if ( $this->_user === null ){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			$this->errorMessage = '用户不存在';
			return false;
		}else {
			return true;
		}
	}
}