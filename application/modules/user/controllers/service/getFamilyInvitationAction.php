<?php
/**
 * @name getFamilyInvitationAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-29
 * Encoding UTF-8
 */
class getFamilyInvitationAction extends CmsAction{
	public function run($resourceId){
		$loginedId = $this->app->getUser()->getId();
		if ( $loginedId !== $resourceId ){
			$this->response(402);
		}
		$familyTypeFlag = 100;
		$groupManager = $this->app->getModule('friends')->getGroupManager();
		$families = $groupManager->getGroups($loginedId,$familyTypeFlag);
		
		$response = array();
		foreach ( $families as $family ){
			$f = $family->getRelated('group');
			$response[] = array(
					'id' => $f->getPrimaryKey(),
					'name' => $f->getAttribute('group_name')
			);
		}
		$this->response(300,'',$response);
	}
}