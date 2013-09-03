<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-3
 * Encoding GBK 
 */
class ServiceTest extends CDbTestCase{
	/**
	 * @var UserModule
	 */
	public $userModule;
	
	protected function setUp(){
		parent::setUp();
		$this->userModule = Yii::app()->getModule('user');
	}
	
	public function testLogin(){
		$model = new SqbLoginForm('app');
		$data = array(
				'account' => '13372672914',
				'password' => 'lancelot'
		);
		$model->attributes = $data;
		
		if ( $model->login() ){
			$this->response(200,'登录成功');
		}else {
			$this->response(400,'登录失败',$model->getErrors());
		}
	}
}