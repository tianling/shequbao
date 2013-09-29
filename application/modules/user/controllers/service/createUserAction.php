<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-9
 * Encoding GBK 
 */
class createUserAction extends CmsAction{
	public function run(){
		if ( $this->app->getUser()->getIsGuest() ){
			$uManager = $this->app->getComponent('UserManager');
			
			$attributes = $this->getPost();
			$attributes['last_login_ip'] = $this->request->userHostAddress;
			$response = $uManager->addAppUser($attributes);
				
			if ( !$response->hasErrors() ){
				$this->response(200,'注册成功');
			}else {
				$this->response(201,$response->getErrors());
			}
		}else {
			$this->response(401,'请退出之后注册');
		}
	}
}