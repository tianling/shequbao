<?php
/**
 * @name pushMeesageAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class pushMessageAction extends CmsAction{
	public function run(){
		$communityId = $this->getQuery('community',null);
		if ( $communityId === null ){
			$this->redirect($this->createUrl('community/view'));
		}
		$propertyId = $this->app->getUser()->getState('property_id');
		if ( $propertyId === null ){
			$this->getController()->showMessage('您不是物管公司成员，不能操作','/site/welcome');
		}
		
		$exist = PropertyCommunity::model()->exists('property_id=:pid AND community_id=:cid',array(':pid'=>$propertyId,':cid'=>$communityId));
		if ( $exist === false ){
			$this->getController()->showMessage('您无权向该小区推送','/site/welcome');
		}
		
		$model = new PushMessageForm();
		$post = $this->getPost('PushMessageForm',null);
		
		if ( $post !== null ){
			$model->attributes = $post;
			if ( $model->validate() ){
				$room = ChatRoom::model()->find('community_id=:cid',array(':cid'=>$communityId));
				if ( $room === null ){
					$this->getController()->showMessage('参数错误','community/view');
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
					$this->getController()->showMessage('推送成功','community/view');
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