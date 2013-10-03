<?php
/**
 * @name SqbController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-2
 * Encoding UTF-8
 */
class SqbController extends CmsController{
	public $imgUrl;
	public $cssUrl;
	public $jsUrl;
	public $user;
	public $layout = '//layouts/right';
	
	public function init(){
		parent::init();
		$this->imgUrl = $this->request->baseUrl.'/images/';
		$this->cssUrl = $this->request->baseUrl.'/css/';
		$this->jsUrl = $this->request->baseUrl.'/js/';
		$this->user = $this->app->getUser();
	}
	
	public function loginRequired(){
		$this->redirect($this->createUrl('/site/login'));
	}
}