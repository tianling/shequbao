<?php
/**
 * @name addAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class addAction extends CmsAction{
	public function run(){
		$propertyId = $this->app->user->getState('property_id');
		if ( $propertyId === null ){
			$this->getController()->showMessage('您不是物管公司成员，不能操作','/site/welcome');
		}
		
		$model = new Community();
		$post = $this->getPost('Community',null);
		if ( $post !== null ){
			$model->attributes = $post;
			if ( $model->save() ){
				$chatRoomModel = new ChatRoom;
				$chatRoomModel->community_id = $model->id;
				$chatRoomModel->room_name = $model->community_name;
				$chatRoomModel->save();
					
				$property = new PropertyCommunity();
				$property->attributes = array(
						'community_id' => $model->id,
						'property_id' => $propertyId
				);
				$property->save();
				
				$this->getController()->showMessage('添加成功','community/view');
			}
		}
		
		$this->pageTitle = '添加小区';
		$form = $this->getController()->getCommunityForm($model);
		$this->render('add',array('form'=>$form));
	}
}