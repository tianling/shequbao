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
		Yii::import('user.models.*');
		Yii::import('user.components.*');
		
		Yii::app()->setComponent('user',array(
				'stateKeyPrefix' => Yii::app()->params['frontUserStateKeyPrefix'],
				'allowAutoLogin' => true,
				'guestName' => '游客',
				//'authTimeout' => 600
		));
	}
	
	public static function loadSelfModels(){
		Yii::import('user.models.*');
	}
}