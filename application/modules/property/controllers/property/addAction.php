<?php
/**
 * @name addAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class addAction extends CmsAction{
	public function run(){
		$model = new Property();
		
		$post = $this->getPost('Property',null);
		if ( $post !== null ){
			$model->attributes = $post;
			if ( $model->save() ){
				$this->getController()->showMessage('添加成功','property/view');
			}
		}
		
		$this->pageTitle = '添加物管';
		$form = $this->getController()->getForm($model);
		$this->render('add',array('form'=>$form));
	}
}