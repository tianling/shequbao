<?php
class CommunityModule extends CmsModule{
	public function init(){
		Yii::import('community.components.*');
		Yii::import('community.models.*');
		Yii::import('application.helpers.*');
		Yii::app()->setComponents(array(
				'CommunityManager' => array(
						'class' => 'community.components.CommunityManager'
				),
		));
	}

}
?>