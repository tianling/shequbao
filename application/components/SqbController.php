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
	public $pluginUrl;
	/**
	 * 
	 * @var AuthUser
	 */
	public $user;
	
	public $subNavs = array();
	
	public $layout = '//layouts/right';
	
	public function init(){
		parent::init();
		$this->imgUrl = $this->request->baseUrl.'/images/';
		$this->cssUrl = $this->request->baseUrl.'/css/';
		$this->jsUrl = $this->request->baseUrl.'/js/';
		$this->pluginUrl = $this->request->baseUrl.'/plugins/';
		$this->user = $this->app->getUser();
		
		$this->addToSubNav('首页','/site/welcome');
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
	
	public function loginRequired(){
		$this->redirect($this->createUrl('/site/login'));
	}
	
	public function addToSubNav($text,$route,$title='',$urlParams=array()){
		$html = $this->renderPartial('//common/subNavButton',array('text'=>$text,'url'=>$this->createUrl($route,$urlParams),'title'=>$title),true);
		$this->subNavs[] = $html;
	}
	
	public function showMessage($message,$redirectUrl,$wait=5,$terminate=true){
		$url = $this->createUrl($redirectUrl);
		$this->renderPartial('//common/flashMessage',array(
				'waitSeconds' => $wait,
				'jumpUrl' => $url,
				'msg' => $message
		));
		if ( $terminate === true ){
			$this->app->end();
		}
	}
	
	public function registerTreePlugin($treetableFunctions=array()){
		$cs = $this->app->getClientScript();
		$url = $this->pluginUrl;
		
		$funcs = '';
		foreach ( $treetableFunctions as $func ){
			$funcs .= $func.';';
		}
		$script = '$(function(){
	var options = {
			expandable: true,
	};
	$("#tree").treetable(options);'.$funcs.'
});';
	
		$cs->registerScriptFile($url.'treetable/javascripts/src/jquery.treetable.js',CClientScript::POS_END);
		$cs->registerScript('tree',$script,CClientScript::POS_END);
		$cs->registerCssFile($url.'treetable/stylesheets/jquery.treetable.css');
		$cs->registerCssFile($url.'treetable/stylesheets/jquery.treetable.theme.default.css');
	}
	
	public function accessDenied(){
		$this->showMessage('您无权访问此页面','/site/welcome');
	}
}