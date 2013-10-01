<?php
/**
 * @name SiteController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-9
 * Encoding UTF-8
 */
class SiteController extends CmsController{
	public $defaultAction='login';
	
	public function filters(){
		return array();
	}
	
	public function actionLogin(){
		var_dump($this->app->getUser());die;
		if ( $this->app->getUser()->getIsGuest() === false ){
			$this->redirect($this->request->urlReferrer);
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
				$this->redirect($moduleId.'/');
			}
		}
		
		$this->render('login',array('model'=>$model));
	}
}