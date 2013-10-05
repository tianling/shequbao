<?php
/**
 * @name editAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
class editAction extends CmsAction{
	public function run(){
		$id = $this->getQuery('id',null);
		if ( $id === null )
			$this->redirect($this->createUrl('user/view'));
		
		$model = Administrators::model()->with('baseUser')->findByPk($id);
		$post = $this->getPost('Administrators',null);
		
		if ( $model !== null && $post !== null ){
			$oldPasswd = $model->password;
			$model->attributes = $post;
			if ( $post['password'] !== '' ){
				$model->baseUser->changePassword($post['password']);
			}else {
				$model->password = $oldPasswd;
			}
		
			if ( $model->save() ){
				$this->getController()->showMessage('编辑成功','user/view');
			}
		}
		
		$model->password = '';
		$action = $this->createUrl('user/edit',array('id'=>$id));
		$this->setPageTitle('编辑管理员');
		$this->render('add',array('action'=>$action,'model'=>$model));
	}
}