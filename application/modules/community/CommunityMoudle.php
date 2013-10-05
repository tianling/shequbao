<?php
class CommunityModule extends CmsModule{
	public function init(){
		$this->defaultController = 'index';
		
		Yii::import('community.components.*');
		Yii::import('community.models.*');
		Yii::import('application.helpers.*');
		Yii::app()->setComponents(array(
				'CommunityManager' => array(
						'class' => 'community.components.CommunityManager'
				),
				'user' => array(
						//'stateKeyPrefix' => 'ADVERTISER',
						'allowAutoLogin' => false,
						'guestName' => '游客',
						//'authTimeout' => 600
				)
		));
	}
	
}
?>