<?php
/**
 * @name PropertyModule.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-9
 * Encoding UTF-8
 */
class PropertyModule extends CmsModule{
	public function init(){
		parent::init();
		Yii::import('application.modules.property.models.*');
	}
	
	public static function loadSelfModels(){
		Yii::import('application.modules.property.models.*');
	}
}