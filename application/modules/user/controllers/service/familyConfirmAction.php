<?php
/**
 * @name familyConfirmAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-29
 * Encoding UTF-8
 */
class familyConfirmAction extends CmsAction{
	public function run($resourceId){
		$loginedId = $this->app->getUser()->getId();
		if ( $loginedId !== $resourceId ){
			$this->response(402);
		}
		
		$familyTypeFlag = 100;
		$groupManager = $this->app->getModule('friends')->getGroupManager();
		$type = $this->getPost('type',null);
		$groupId = $this->getPost('group',null);
		$userId = $this->getPost('user',null);
		if ( $groupId === null || $userId === null ){
			$this->response(201);
		}
		$result = $groupManager->confirmGroupAdd($loginedId,$groupId,$userId);
		if ( $result === true ){
			$this->response(200);
		}else {
			$this->response(201);
		}
	}
}