<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-9
 * Encoding GBK 
 */
class getUserAddressAction extends CmsAction{
	public function run($resourceId){
		if ( $this->app->getUser()->getId() !== $resourceId ){
			$this->response(403,'只能查看自己的住址');
		}
		
		$addresses = UserAddress::model()->getUserAddressesArray($resourceId);
		$this->response(200,'',$addresses);
	}
}