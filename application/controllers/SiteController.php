<?php
/**
 * @name SiteController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-9
 * Encoding UTF-8
 */
class SiteController extends CmsController{
	public function actionIndex(){
// 		Yii::app()->getAuthManager();
// 		$role = AuthRoles::model()->findByPk(2);
// 		$role->fid = 1;
// 		$role->save();

		
		$data = array(
				'nickname' => 'testNick',
				'realname' => 'real',
				'email' => 'testEmail',
				'password' => 'testPassword',
				'salt' => 'testSalt',
				'last_login_time' => time(),
				'last_login_ip' => '127.0.0.1',
				'locked' => 1,
				'surname' => 'surname',
				'name' => 'testName'
		);
		//foreach ( $data as $key => $value ){
		//	$user->$key = $value;
		//}
		$user = new Administrators('create');
		$user->attributes = $data;
		$user->save();
		$errors = $user->getErrors();
		var_dump($errors);
	}
}