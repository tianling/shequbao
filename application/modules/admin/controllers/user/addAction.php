<?php
/**
 * @name addAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
class addAction extends CmsAction{
	public function run(){
		$model = new Administrators();
		
		$post = $this->getPost('Administrators',null);
		
		if ( $post !== null ){
			$post['last_login_ip'] = $this->request->userHostAddress;
			$post['last_login_time'] = time();
			$model->attributes = $post;
				
			if ( $model->save() ){
				$this->getController()->showMessage('添加成功','user/view');
			}
		}
		
		$action = $this->createUrl('user/add');
		$this->setPageTitle('添加管理员');
		$this->render('add',array('action'=>$action,'model'=>$model));
	}
}