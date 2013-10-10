<?php
/**
 * @name editAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class editAction extends CmsAction{
	public function run(){
		$id = $this->getQuery('id',null);
		if ( $id === null ){
			$this->redirect($this->createUrl('property/view'));
		}
		
		$model = Property::model()->findByPk($id);
		$post = $this->getPost('Property',null);
		if ( $model !== null && $post !== null ){
			$model->attributes = $post;
			if ( $model->save() ){
				$this->getController()->showMessage('编辑成功','property/view');
			}
		}
		
		$form = $this->getController()->getForm($model);
		$this->pageTitle = '编辑物管';
		$this->render('add',array('form'=>$form));
	}
}