<?php
/**
 * @name addAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-6
 * Encoding UTF-8
 */
class addAction extends CmsAction{
	public function run(){
		$response = new SqbUser();
		
		$post = $this->getPost('SqbUser',null);
		if ( $post !== null ){
			$uManager = $this->app->getComponent('UserManager');
			
			$post['last_login_ip'] = 'N/A';
			$response = $uManager->addAppUser($post);
			
			if ( !$response->hasErrors() ){
				$this->getController()->showMessage('添加成功','manage/view');
			}
		}
		
		$action = $this->createUrl('manage/add');
		$this->setPageTitle('添加用户');
		$this->render('add',array('action'=>$action,'model'=>$response));
	}
}