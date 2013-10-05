<?php
/**
 * @name editAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-6
 * Encoding UTF-8
 */
class editAction extends CmsAction{
	public function run(){
		$id = $this->getQuery('id',null);
		if ( $id === null )
			$this->redirect($this->createUrl('manage/view'));
		
		$model = SqbUser::model()->with('baseUser')->findByPk($id);
		
		$model->setScenario('appReg');
		$className = get_class($model);
		$post = $this->getPost($className,null);
		if ( $model !== null && $post !== null ){
			$model->attributes = $post;
		
			if ( $model->save() ){
				$this->getController()->showMessage('修改成功','manage/view');
			}
		}
		
		$formConfig = $this->getFormConfig();
		
		
		$form = new CForm($formConfig,$model);
		$form->action = $this->createUrl('',array('id'=>$id));
		$this->setPageTitle('修改操作');
		
		$this->render('edit',array('form'=>$form));
	}
	
	public function getFormConfig(){
		return array(
				'elements' => array(
						'mobile' => array(
								'type' => 'text',
								'label' => '手机号',
								'class' => 'form-input-text',
						),
						'email' => array(
								'type' => 'text',
								'label' => '邮箱',
								'class' => 'form-input-text',
						),
						'icon' => array(
								'type' => 'hidden'
						)
				),
				'buttons' => array(
						'submit' => array(
								'type' => 'submit',
								'label' => '确定',
								'class' => 'form-button form-button-submit'
						)
				)
		);
	}
}