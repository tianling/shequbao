<?php
/**
 * @name SiteLoginForm.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-16
 * Encoding UTF-8
 */
class SiteLoginForm extends CFormModel{
	public $account;
	public $password;
	/**
	 *
	 * @var CUserIdentity
	 */
	private $_identity=null;
	/**
	 * 
	 * @var string
	 */
	private $_identityName = null;
	
	public function rules(){
		return array(
				array('account,password','required','message'=>'请填写{attribute}'),
		);
	}
	
	public function attributeLabels(){
		return array(
				'account' => '账号',
				'password' => '密码',
		);
	}
	
	/**
	 *
	 * @param string $identity
	 */
	public function setIdentityName($identityName){
		$this->_identityName = $identityName;
	}
	
	/**
	 * 
	 * @return CUserIdentity
	 */
	public function getIdentity(){
		return $this->_identity;
	}
	
	/**
	 * @return boolean
	 */
	public function login($duration=0){
		if ( $this->_identityName !== null && $this->validate() ){
			$identityClass = $this->_identityName;
			$this->_identity = new $identityClass($this->account,$this->password);
			if ( $this->_identity->authenticate() ){
				Yii::app()->getUser()->login($this->_identity,$duration);
				return true;
			}else {
				$this->addError('password',$this->_identity->errorMessage);
				return false;
			}
		}else {
			return false;
		}
	}
}