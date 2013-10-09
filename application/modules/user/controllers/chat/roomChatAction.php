<?php
/**
 * @name roomChatAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-9
 * Encoding UTF-8
 */
class roomChatAction extends CmsAction{
	public function run(){
		$roomId = $this->getQuery('id',null);
		if ( $roomId === null ){
			$this->redirect($this->createUrl('chat/viewChat'));
		}
		$room = ChatRoom::model()->findByPk($roomId,array('select'=>'room_name'));
		if ( $room === null ){
			$this->redirect($this->createUrl('chat/viewChat'));
		}
		
		$data = array();
		$pager = null;
		$roomName = $room->room_name;
		$model = RoomMessage::model();
		$criteria = new CDbCriteria();
		
		$criteria->params = array(
				':r' => $roomId
		);
		$criteria->addCondition('receive_room=:r');
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