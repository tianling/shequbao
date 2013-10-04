<?php
/**
 * @name resetPasswordAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-4
 * Encoding UTF-8
 */
class resetPasswordAction extends CmsAction{
	public function run(){
		$account = $this->getPost('account',null);
		$vrificationCode = $this->getPost('code',null);
		$password = $this->getPost('password');
		if ( $account === null || $vrificationCode === null || $password === null ){
			$this->response(201,'参数错误');
		}
		
		$criteria = new CDbCriteria();
		$criteria->select = 'email';
		$criteria->condition = 'mobile=:a OR email=:a';
		$criteria->params = array(':a'=>$account);
		
		$user = SqbUser::model()->with('baseUser')->find($criteria);
		if ( $user === null ){
			$this->response(201,'用户不存在');
		}
		
		$vrificationCode = intval($vrificationCode);
		$email = $user->email;
		
		$cache = $this->app->cache;
		$cache->keyPrefix = 'APP_VERIFICATION_CODE_';
		$cachedCode = $cache->get($email);
		
		if ( $cachedCode === $vrificationCode ){
			$user->baseUser->password = $password;
			if ( $user->validate() ){
				$user->changePassword($password);
				$user->save(false);
				//$cache->delete($email);
				$this->response(200,'修改成功');
			}else {
				$this->response(201,'修改失败',$user->getErrors());
			}
		}else {
			$this->response(201,'验证码错误');
		}
	}
}