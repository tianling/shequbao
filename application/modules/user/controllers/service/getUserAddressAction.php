<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-9
 * Encoding GBK 
 */
class getUserAddressAction extends CmsAction{
	public function run($resourceId){
		if ( $this->app->getUser()->getId() !== $resourceId ){
			$this->response();
		}
		
		$addresses = UserAddress::model()->getUserAddressesArray($resourceId);
		$this->response(200,'',$addresses);
	}
}