<?php
/**
 * @name TestController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-11
 * Encoding UTF-8
 */
class TestController extends SqbController{
	public function init(){
		parent::init();
		
		$this->attachBehavior('curl','curlBehavior');
		$this->attachBehavior('curlMulti','curlMultiBehavior');
	}
	
	public function filters(){
		return array();
	}
	
	public function actionIndex(){
		//$url = 'http://202.202.43.125/online/portal.php';
		$url = 'http://202.202.43.41/market/';
		$handlers = array();
		$curl = $this->curl;
		$curlMulti = $this->curlMulti;
		$curlMulti->setMaxConnections(5000);
		$i = 0;
		while ( $i++ < 1200 ){
			$handlers[] = $curl->getCurlHandler(true);
			$curl->setUrl($url);
			$curl->setReturn(true);
			$curl->setMethod('GET');
			$curl->curlBuildOpts();
		}
		
		$curlMulti->addHandlersToMultiHandler($handlers);
		set_time_limit(200);
		$start = microtime(true);
		if ( $curlMulti->exec() ){
			$read = $curlMulti->getReadableHandlers();
			echo microtime(true) - $start.'...';
			echo count($read);die;
			foreach ( $read as $r ){
				var_dump($curlMulti->getContent($r));
			}
echo 'success';
		}else {
			echo '321312';
		}
	}
	
	
	
	
	
	
}