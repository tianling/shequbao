<?php
/**
 * @name ServiceController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-31
 * Encoding UTF-8
 */
class ServiceController extends CmsController{
	
	public $actionClassPathAlias = 'application.modules.user.controllers';
	
	public function getActionClass(){
		return array(
				'create' => array('class' => 'createUser'),
				'update' => array('class' => 'updateUser'),
				'createAddress' => array('class' => 'createUserAddress'),
				'updateAddress' => array('class' => 'updateUserAddress'),
				'getAddress' => array('class' => 'getUserAddress'),
				'getBind' => array('class' => 'getUserBindInfo')
		);
	}
	
	public function filters(){
		$filters = parent::filters();
		$filters['hasLogined'][0] = $filters['hasLogined'][0].' - create,login';
		
		return $filters;
	}
	
	public function actionLogin(){
		if ( $this->app->getUser()->getIsGuest() ){
			$model = new SqbLoginForm('app');
			$model->attributes = $this->getRestParam();
			
			if ( $model->login(3600*24*30) ){
				$this->response(100,'登录成功',$model->getIdentity()->getReturnStates());
			}else {
				$this->response(102,'登录失败',$model->getErrors());
			}
		}else {
			$this->response(103,'请不要重复登录');
		}
	}
	
	public function actionLogout(){
		$this->app->getUser()->logout();
		$this->response(101,'退出成功');
	}
	
	public function loginRequired(){
		$this->response(104,'请登录');
	}
}