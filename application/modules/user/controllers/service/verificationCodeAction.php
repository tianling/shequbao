<?php
/**
 * @name createVerificationCodeAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-4
 * Encoding UTF-8
 */
class verificationCodeAction extends CmsAction{
	public function run(){
		$account = $this->getPost('account',null);
		if ( $account === null ){
			$this->response(201);
		}
		
		$criteria = new CDbCriteria();
		$criteria->select = 'email';
		$criteria->condition = 'mobile=:a OR email=:a';
		$user = UserModel::model()->find($criteria,array(':a'=>$account));
		if ( $user === null ){
			$this->response(201,'用户不存在');
		}
		
		$mailer = $this->app->mailer;
		
		$code = mt_rand(1000000,999999);
		$email = $user->email;
		
		$mailer->AddAddress($email);
		$mailer->Subject = '社区宝密码重置';
		$mailer->Body = '您的验证码是：'.$code.'。请在手机中输入此验证码以重置密码。';
		$result = $mailer->Send();
		if ( $result === true ){
			$cache = $this->app->cache;
			$cache->keyPrefix = 'APP_VERIFICATION_CODE_';
			$cache->set($email,$code);
		}else {
			$this->response(201,'邮箱错误');
		}
		
	}
}