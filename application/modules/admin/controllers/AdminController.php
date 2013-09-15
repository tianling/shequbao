<?php
/**
 * @name AdminController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-15
 * Encoding UTF-8
 */
class AdminController extends CmsController{
	public $defaultAction='login';
	
	public function filters(){
		$filters = parent::filters();
		$filters['hasLogined'][0] = $filters['hasLogined'][0].' - login';
	}
	
	public function actionLogin(){
		if ( $this->app->getUser()->getIsGuest() === false ){
			$this->redirect($this->createUrl('admin/welcome'));
		}
		$this->layout = false;
		$this->render('login');
	}
	
	public function actionLogout(){
		$this->app->getUser()->logout();
		$this->redirect($this->createUrl('admin'));
	}
	
	public function actionMenu(){
		echo 'dsad';
	}
	
	public function actionWelcome(){
		echo 'dsadsa';
	}
}