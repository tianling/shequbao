<?php
/**
 * @name ManageController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-6
 * Encoding UTF-8
 */
class ManageController extends SqbController{
	public $actionClassPathAlias = 'application.modules.user.controllers';
	public $defaultAction = 'view';
	
	public function getActionClass(){
		return array(
				'view',
				'edit',
				'add',
				'addMulti'
		);
	}
}