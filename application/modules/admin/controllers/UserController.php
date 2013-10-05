<?php
/**
 * @name UserController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
class UserController extends SqbController{
	public $defaultAction = 'view';
	public $actionClassPathAlias = 'sqbadmin.controllers';
	
	public function getActionClass(){
		return array(
				'add',
				'edit',
				'view',
				'delete'
		);
	}
}