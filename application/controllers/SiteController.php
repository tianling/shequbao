<?php
/**
 * @name SiteController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-9
 * Encoding UTF-8
 */
class SiteController extends SqbController{
	public $defaultAction='login';
	
	public function filters(){
		$filters = parent::filters();
		$filters['hasLogined'][0] = $filters['hasLogined'][0].' - login';
		$filters['accessControl'] .= ' - menu,welcome';
		return $filters;
	}
	
	public function actionLogout(){
		$this->app->getUser()->logout();
		$this->redirect($this->createUrl('/site'));
	}
	
	public function actionLogin(){
		if ( $this->app->getUser()->getIsGuest() === false ){
			$this->redirect($this->createUrl('/site/index'));
		}
		$this->layout = false;
		$this->setPageTitle('社区宝管理系统登录');
		
		$model = new SiteLoginForm();
		$post = $this->getPost('SiteLoginForm');
		
		if ( $post !== null ){
			$moduleId = $post['loginType'] == 0 ? 'sqbadmin' : 'ad';
			$model->setIdentityName($this->app->getModule($moduleId)->getIdentityName());
			$model->attributes = $post;
			if ( $model->login() ){
				$this->redirect($this->createUrl('/site/index'));
			}
		}
		$model->password = '';
		$this->render('login',array('model'=>$model));
	}
	
	public function actionIndex(){
		$this->layout = '//layouts/main';
		$this->pageTitle = '社区宝管理系统';
		$this->render('index');
	}
	
	public function actionMenu(){
		$authMenu = $this->app->getAuthManager()->getMenu();
		$this->menu = $authMenu->generateUserMenu($this->app->getUser()->getId());
		$this->layout = false;
		$this->render('menu');
	}
	
	public function actionWelcome(){
		$this->pageTitle = '欢迎界面';
		$this->render('welcome');
	}
}