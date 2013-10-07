<?php
class CommunityModule extends CmsModule{

	public function init(){
		//$this->defaultController = 'index';
		
		Yii::import('community.components.*');
		Yii::import('community.model.*');
		Yii::import('application.helpers.*');
		Yii::app()->setComponents(array(
				'CommunityManager' => array(
						'class' => 'community.components.CommunityManager'
				),

				'user' => array(
						'allowAutoLogin' => false,
						'guestName' => '游客',
				)
				
		));
	}

}
?>