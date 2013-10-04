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
	
	public $subNavs = array();
	
	public $layout = '//layouts/right';
	
	public function init(){
		parent::init();
		$this->imgUrl = $this->request->baseUrl.'/images/';
		$this->cssUrl = $this->request->baseUrl.'/css/';
		$this->jsUrl = $this->request->baseUrl.'/js/';
		$this->user = $this->app->getUser();
	}
	
	public function accessRules(){
		$ipAllow = array(
// 				array('allow',
// 						'ips' => array('127.0.0.1'),
// 						'deniedCallback' => array($this,'accessDenied')
// 				),
		);
		return array_merge($ipAllow,parent::accessRules());
	}
	
	public function loginRequired(){
		$this->redirect($this->createUrl('/site/login'));
	}
	
	public function addToSubNav($text,$url){
		$html = $this->renderPartial('//common/subNavButton',array('text'=>$text,'url'=>$url),true);
		$this->subNavs[] = $html;
	}
}