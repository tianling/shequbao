<?php
/**
 * @name SqbLoginForm.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-2
 * Encoding UTF-8
 */
class SqbLoginForm extends CFormModel{
	/**
	 * @var string
	 */
	public $account;
	/**
	 * @var string
	 */
	public $password;
	/**
	 * @var AppUserIdentity
	 */
	private $_identity;
	
	/**
	 * @see CModel::rules()
	 */
	public function rules(){
		return array(
				array('account,password','required','message'=>'{attribute}不能为空')
		);
	}
	
	public function attributeLabels(){
		return array(
				'account' => '账号',
				'password' => '密码'
		);
	}
	
	/**
	 * @return boolean
	 */
	public function login($duration=0){
		if ( $this->validate() ){
			$this->_identity = new AppUserIdentity($this->account,$this->password);
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
	
	/**
	 * @return AppUserIdentity
	 */
	public function getIdentity(){
		return $this->_identity;
	}
}