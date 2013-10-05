<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-9
 * Encoding GBK 
 */
class createUserAddressAction extends CmsAction{
	public function run($resourceId){
		if ( $this->app->getUser()->getId() === $resourceId ){
			$address = new UserAddress();
			$newAttributes = $this->getController()->getPost();
			$newAttributes['user_id'] = $resourceId;
			$address->attributes = $newAttributes;
			if($address->save()){
				if ( isset($newAttributes['community']) ){
					$cId = $newAttributes['community'];
					$cu = new CommunityUser();
					$cu->attributes = array(
							'community_id' => $cId,
							'user_id' => $resourceId
					);
					$cu->save();
					
					$room = ChatRoom::model()->find('community_id=:c',array(':c'=>$cId));
					if ( $room === null ){
						$community = Community::model()->findByPk($cId,array('select'=>'community_name'));
						$room = new ChatRoom();
						$room->attributes = array(
								'community_id' => $cId,
								'room_name' => $community->community_name,
								'user_num' => 1
						);
					}else {
						++$room->user_num;
					}
					$room->save();
					
					$ownedRoom = new UserOwnedChat();
					$ownedRoom->attributes = array(
							'room_id' => $room->primaryKey,
							'user_id' => $resourceId
					);
					$ownedRoom->save();
				}
				
				$this->response(200,'添加地址成功');
			}else{
				$this->response(201,'添加地址失败',$address->getErrors());
			}
		}
		$this->response(402,'添加地址失败');
	}
}