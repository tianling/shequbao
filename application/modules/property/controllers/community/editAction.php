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
		$propertyId = $this->app->user->getState('property_id');
		if ( $propertyId === null ){
			$this->getController()->showMessage('您不是物管公司成员，不能操作','/site/welcome');
		}
		
		$id = $this->getQuery('id',null);
		if ( $id === null ){
			$this->redirect($this->createUrl('community/view'));
		}
		
		$model = Community::model()->findByPk($id);
		$post = $this->getPost('Community',null);
		if ( $model !== null && $post !== null ){
			$model->attributes = $post;
			if ( $model->save() ){
				$this->getController()->showMessage('添加成功','community/view');
			}
		}
		
		$this->pageTitle = '编辑小区';
		$form = $this->getController()->getCommunityForm($model);
		$this->render('add',array('form'=>$form));
		
	}
}