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
		$familyId = $this->getPost('family',null);
		if ( $familyId === null ){
			$this->response(201);
		}
		$family = $groupManager->findByPk($familyId);
		if ( $family === null ){
			$this->response(201,'家庭不存在');
		}
		$result = $groupManager->confirmGroupAdd($family->master_id,$familyId,$loginedId);
		if ( $result === true ){
			$chatManager = $this->app->getComponent('chatManager');
			$chatManager->getPusher()->setTimeToLive(864000);
			$alias = 'user'.$family->master_id;
			
			$extras[] = time();
			$extras['ios'] = array(
					'badge' => 1,
					'sound' => 'happy'
			);
			$chatManager->pushNotification(1,$alias,1,'家庭成员同意加入您的家庭','社区宝聊天',$extras);
			
			$this->response(200);
		}else {
			$this->response(201);
		}
	}
}