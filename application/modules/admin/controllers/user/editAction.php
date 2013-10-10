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
			$model->attributes = $post;
			if ( $model->validate() ){
				if ( $post['password'] !== '' ){
					$model->baseUser->changePassword($post['password']);
				}
				
				$model->save(false);
				$this->getController()->showMessage('编辑成功','user/view');
			}
		}
		
		$model->password = '';
		$form = $this->getController()->getForm($model);
		$this->setPageTitle('编辑管理员');
		$this->render('add',array('form'=>$form));
	}
}