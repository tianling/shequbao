<?php
/**
 * @name UserModule.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-1
 * Encoding UTF-8
 */
class UserModule extends CmsModule{
	public function init(){
		Yii::import('application.modules.user.models.*');
		Yii::import('application.modules.user.components.*');
	}
	
	public static function loadSelfModels(){
		Yii::import('application.modules.user.models.*');
	}
	
	public function configureUser(){
		Yii::app()->setComponent('user',array(
		'stateKeyPrefix' => Yii::app()->params['frontUserStateKeyPrefix'],
		'allowAutoLogin' => true,
		'guestName' => '游客',
		'authTimeout' => 3600
		));
	}
}