<?php
/**
 * @name ServiceController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-31
 * Encoding UTF-8
 */
class ServiceController extends CmsController{
	
	public function actionSignUp(){
		$user = new SqbUser();
		$attributes = $this->getPost();
		$attributes['last_login_time'] = time();
		$attributes['last_login_ip'] = $this->request->userHostAddress;
		
		$user->attributes = $attributes;
		
		if ( $user->save() ){
			$this->response(200,'注册成功');
		}else {
			$this->response(405,$user->getErrors());
		}
	}
}