<?php
/**
 * @name SqbController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-16
 * Encoding UTF-8
 */
class SqbController extends CmsController{
	public function filters(){
		$filters = parent::filters();
		$filters['accessControl'] .= ' - menu,welcome';
		return $filters;
	}
	
	public function accessRules(){
		$ipAllow = array(
				array('allow',
						'ips' => array('127.0.0.1'),
						'deniedCallback' => array($this,'accessDenied')
				),
		);
		return array_merge($ipAllow,parent::accessRules());
	}
	
	public function actionLogout(){
		$this->app->getUser()->logout();
		$this->redirect($this->createUrl('/site/'));
	}
	
	public function actionMenu(){
		$authMenu = $this->app->getAuthManager()->getMenu();
		$this->menu = $authMenu->generateUserMenu($this->app->getUser()->getId());
		$this->layout = false;
		$this->render('//common/menu');
	}
	
	public function actionWelcome(){
		
	}
}