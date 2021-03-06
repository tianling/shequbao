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
		
		$dir = $this->app->basePath.DS.'../upload'.DS.'contacts'.DS;
		$fileName = md5($loginedId).'.json';
		$file = $dir.$fileName;
		if ( file_exists($file) ){
			$this->request->xSendFile($file,array('mimeType'=>'application/json','terminate'=>true));
		}else {
			$this->response(300,'文件不存在');
		}
		
	}
}