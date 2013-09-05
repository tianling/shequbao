<?php
/**
 * @name SiteController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-9
 * Encoding UTF-8
 */
class SiteController extends CmsController{
	public function filters(){
		return array();
	}
	
	public function actionIndex(){
		$operation = array(
				'module' => 'access3',
				'controller' => 'access3',
				'action' => 'access3'
		);
		$r = Yii::app()->getAuthManager()->checkAccess($operation,35);
		var_dump($r);
	}
}