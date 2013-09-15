<?php
/**
 * @name AdminModule.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-15
 * Encoding UTF-8
 */
class AdminModule extends CmsModule{
	public function init(){
		$this->defaultController = 'admin';
		
		Yii::import('sqbadmin.models.*');
		Yii::import('sqbadmin.components.*');
		Yii::app()->setComponent('user',array(
				'stateKeyPrefix' => 'ADMIN_USER',
				'allowAutoLogin' => false,
				'guestName' => '游客',
				//'authTimeout' => 600
		));
	}
	
	public function getIdentityName(){
		return 'AdminIdentity';
	}
}