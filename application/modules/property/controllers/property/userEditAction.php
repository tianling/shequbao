<?php
/**
 * @name userEditAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class userEditAction extends CmsAction{
	public function run(){
		$id = $this->getQuery('id',null);
		if ( $id === null ){
			$this->redirect($this->createUrl('property/userView'));
		}
		$model = PropertyAdmin::model()->with('baseUser')->findByPk($id);
		$post = $this->getPost('PropertyAdmin',null);
		if ( $model !== null && $post !== null ){
			$model->attributes = $post;
			if ( $model->validate() ){
				if ( $post['password'] !== '' ){
					$model->baseUser->changePassword($post['password']);
				}
				
				$model->save(false);
				$this->getController()->showMessage('编辑成功','property/userView');
			}
		}
		
		$model->password = '';
		$form = $this->getController()->getUserForm($model);
		$this->pageTitle = '编辑物管管理员';
		$this->render('userAdd',array('form'=>$form));
	}
}