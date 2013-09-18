<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-9
 * Encoding GBK 
 */
class createUserAction extends CmsAction{
	public function run(){
		if ( $this->app->getUser()->getIsGuest() ){
			$user = new SqbUser('appReg');
			$attributes = $this->getController()->getPost();
			$attributes['last_login_time'] = time();
			$attributes['last_login_ip'] = $this->request->userHostAddress;
			
			$user->attributes = $attributes;
				
			if ( $user->validate() ){
				$user->save(false);
				$this->response(200,'注册成功');
			}else {
				$this->response(201,$user->getErrors());
			}
		}else {
			$this->response(401,'请退出之后注册');
		}
	}
}