<?php
/**
 * @name AssignmentController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
class AssignmentController extends SqbController{
	public $actionClassPathAlias = 'accessManage.controllers';
	
	public function getActionClass(){
		return array(
				'permission',
				'role'
		);
	}
	
	public function actionIndex(){
		$this->pageTitle = '授权管理';
		$this->addToSubNav('角色授权','/user/user/view','将角色授予给用户');
		$this->addToSubNav('操作授权','role/view','将操作授予给角色');
		$this->render('index');
	}
}