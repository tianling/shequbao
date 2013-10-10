<?php
/**
 * @name userAddAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class userAddAction extends CmsAction{
	public function run(){
		$model = new PropertyAdmin();
		$post = $this->getPost('PropertyAdmin',null);
		
		if ( $post !== null ){
			$post['last_login_time'] = time();
			$post['last_login_ip'] = 'N/A';
			$model->attributes = $post;
			if ( $model->save() ){
				$this->getController()->showMessage('添加成功','property/userView');
			}
		}
		
		$form = $this->getController()->getUserForm($model);
		
		$this->pageTitle = '添加物管管理员';
		$this->render('userAdd',array('form'=>$form));
	}
}