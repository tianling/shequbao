<?php
/**
 * @name getMyContactsAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-1
 * Encoding UTF-8
 */
class createMyContactsAction extends CmsAction{
	public function run($resourceId){
		$loginedId = $this->app->getUser()->getId();
		if ( $loginedId !== $resourceId ){
			$this->response(402);
		}
		
		$file = CUploadedFile::getInstanceByName('contacts');
		if ( $file === null ){
			$this->response(201);
		}
		
		$dir = $this->app->basePath.DS.'..'.DS.'upload'.DS.'contacts'.DS;
		$fileName = md5($loginedId).'.json';
		$filePath = $dir.$fileName;
		if ( file_exists($filePath) ){
			unlink($filePath);
		}
		$file->saveAs($filePath);
		$this->response(200);
	}
}