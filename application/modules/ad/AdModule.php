<?php
/**
 * @name AdModule.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-11
 * Encoding UTF-8
 */
class AdModule extends CmsModule{
	public function init(){
		$this->defaultController = 'index';
		
		Yii::import('ad.components.*');
		Yii::import('ad.models.*');
		Yii::app()->setComponents(array(
				'AdManager' => array(
						'class' => 'ad.components.AdManager'
				),
				'user' => array(
						//'stateKeyPrefix' => 'ADVERTISER',
						'allowAutoLogin' => false,
						'guestName' => '游客',
						//'authTimeout' => 600
				)
		));
	}
	
	public function getIdentityName(){
		return 'AdverIdentity';
	}
}