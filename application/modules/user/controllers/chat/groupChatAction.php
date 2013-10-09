<?php
/**
 * @name groupChatAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-8
 * Encoding UTF-8
 */
class groupChatAction extends CmsAction{
	public function run(){
		$groupId = $this->getQuery('id',null);
		if ( $groupId === null ){
			$this->redirect($this->createUrl('chat/viewChat'));
		}
		$group = Groups::model()->findByPk($groupId,array('select'=>'group_name'));
		if ( $group === null ){
			$this->redirect($this->createUrl('chat/viewChat'));
		}
		
		$data = array();
		$pager = null;
		$groupName = $group->group_name;
		$model = GroupMessage::model();
		$criteria = new CDbCriteria();
		
		$criteria->params = array(
				':g' => $groupId
		);
		$criteria->addCondition('receive_group=:g');
		$count = $model->count($criteria);
		
		if ( $count !== 0 ){
			$criteria->with = array(
					'sender' => array(
							'select' => 'nickname'
					)
			);
			$pager = new CPagination($count);
			$pager->pageSize = 50;
			$pager->applyLimit($criteria);
			
			$data = $model->findAll($criteria);
		}
		
		$this->pageTitle = '群聊记录';
		$this->render('viewGroupChat',array('data'=>$data,'pager'=>$pager));
	}
}