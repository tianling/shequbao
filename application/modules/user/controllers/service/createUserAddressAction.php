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
				$this->response(200,'添加地址成功');
			}else{
				$this->response(201,'添加地址失败',$address->getErrors());
			}
		}
		$this->response(402,'添加地址失败');
	}
}