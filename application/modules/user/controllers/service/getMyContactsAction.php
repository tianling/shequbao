<?php
/**
 * @name getMyContactsAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-1
 * Encoding UTF-8
 */
class getMyContactsAction extends CmsAction{
	public function run($resourceId){
		$loginedId = $this->app->getUser()->getId();
		if ( $loginedId !== $resourceId ){
			$this->response(402);
		}
		
		$dir = $this->app->basePath.DS.'upload'.DS.'contacts'.DS;
		$fileName = md5($loginedId).'.json';
		$this->request->xSendFile($dir.$fileName,array('mimeType'=>'application/json','terminate'=>true));
	}
}