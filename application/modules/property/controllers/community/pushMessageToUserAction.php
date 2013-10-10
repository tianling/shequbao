<?php
/**
 * @name pushMessageToUserAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-11
 * Encoding UTF-8
 */
class pushMessageToUserAction extends CmsAction{
	public function run(){
		$userId = $this->getQuery('user',null);
		$communityId = $this->getQuery('community',null);
		if ( $userId === null || $communityId === null ){
			$this->redirect($this->createUrl('community/viewUser'));
		}
		$propertyId = $this->app->getUser()->getState('property_id');
		$propertyId = 1;
		if ( $propertyId === null ){
			$this->getController()->showMessage('您不是物管公司成员，不能操作','/site/welcome');
		}
		
		$exist = CommunityUser::model()->exists('community_id=:cid AND user_id=:uid',array(':cid'=>$communityId,':uid'=>$userId));
		if ( $exist === false ){
			$this->getController()->showMessage('您无权向该用户推送','/site/welcome');
		}
		
		$model = new PushMessageForm();
		$post = $this->getPost('PushMessageForm',null);
		
		if ( $post !== null ){
			$model->attributes = $post;
			if ( $model->validate() ){
				$room = ChatRoom::model()->find('community_id=:cid',array(':cid'=>$communityId));
				if ( $room === null ){
					$this->getController()->showMessage('参数错误','community/viewUser');
				}
				$sendTo = 'room'.$room->primaryKey;
				$extras = array(5,0,$sendTo,time());
				$extras['ios'] = array(
						'badge' => 1,
						'sound' => 'happy'
				);
				$chatManager = $this->app->getModule('friends')->getChatManager();
				$chatManager->getPusher()->setTimeToLive(864000);
				
				$title = '社区宝'.$room->room_name.'物管通知：'.$model->title;
				$result = $chatManager->pushNotification(2,$sendTo,1,$model->content,$title,$extras);
				if ( $result->hasError === false ){
					$this->getController()->showMessage('推送成功','community/viewUser');
				}else {
					$model->addError('content','推送失败');
				}
			}
		}
		
		$this->pageTitle = '推送消息';
		$form = $this->getController()->getPushForm($model);
		$this->render('pushMessage',array('form'=>$form));
	}
}