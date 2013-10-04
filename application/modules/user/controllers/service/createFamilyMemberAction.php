<?php
/**
 * @name createFamilyMemberAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-29
 * Encoding UTF-8
 */
class createFamilyMemberAction extends CmsAction{
	public function run($resourceId){
		$loginedId = $this->app->getUser()->getId();
		if ( $loginedId !== $resourceId ){
			$this->response(402);
		}
		
		$post = $this->getPost();
		if ( !isset($post['mobile']) || !isset($post['email']) || !isset($post['password']) ){
			$this->response(201,'缺少参数');
		}
		
		$familyTypeFlag = 100;
		$groupManager = $this->app->getModule('friends')->getGroupManager();
		$createdFamily = $groupManager->findCreatedGroups($loginedId,$familyTypeFlag);
		$user = SqbUser::model()->with('baseUser')->findByPk($loginedId);
		$member = SqbUser::model()->find('mobile=:m',array(':m'=>$post['mobile']));
		
		if ( $user->equals($member) ){
			$this->response(201,'不能自己邀请自己');
		}
		
		if ( $createdFamily === array() ){
			$fName = $user->getAttribute('nickname').'的家庭';
			$groupManager->maxCreation = 1;
			$family = $groupManager->createGroup($loginedId,$fName,$familyTypeFlag,null,'你已经创建了一个家庭');
		}else {
			$family = $createdFamily[0];
		}
		
		if ( $member !== null ){
			if ( $member->getAttribute('email') !== $post['email'] ){
				$this->response(201,'授权失败，用户邮箱不匹配');
			}
		}else {
			$uManager = $this->app->getComponent('UserManager');
				
			$attributes = $post;
			$attributes['nickname'] = $user->nickname.'的家庭成员';
			$attributes['last_login_ip'] = $this->request->userHostAddress;
			$member = $uManager->addAppUser($attributes);
			if ( $member->hasErrors() ){
				$this->response(201,$member->getErrors());
			}
		}
		
		$result = $groupManager->addMemberToGroup($family->getPrimaryKey(),$member->getPrimaryKey(),$familyTypeFlag);
		if ( $result->hasErrors() ){
			$this->response(201,'邀请已发出，请等待您的家人回复');
		}else {
			$chatManager = $this->app->getComponent('chatManager');
			$chatManager->getPusher()->setTimeToLive(864000);
			$alias = 'user'.$member->getPrimaryKey();
			$chatManager->pushNotification(1,$alias,1,'收到一条家庭邀请，请到家庭查看','社区宝聊天',array('time'=>time()));
			
			$this->response(200,'邀请成功');
		}
	}
}