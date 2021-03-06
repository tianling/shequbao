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
			$this->redirect($this->createUrl('group/view'));
		
		$model = $this->app->getAuthManager()->getItem(AuthManager::GROUP,$id);
		
		$className = get_class($model);
		$post = $this->getPost($className,null);
		if ( $model !== null && $post !== null ){
			$model->attributes = $post;
		
			if ( $model->save() ){
				$this->getController()->showMessage('修改成功','group/view');
			}
		}
		
		$formConfig = $this->getController()->getFormConfig();
		
		
		$form = new CForm($formConfig,$model);
		$form->action = $this->createUrl('',array('id'=>$id));
		$this->setPageTitle('修改操作');
		
		$this->render('add',array('form'=>$form));
	}
}