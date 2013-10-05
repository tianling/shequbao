<?php
/**
 * @name viewAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
class viewAction extends CmsAction{
	public function run(){
		$criteria = new CDbCriteria();
		$count = Administrators::model()->count();
		
		$pager = new CPagination($count);
		$pager->pageSize = 30;
		$pager->applyLimit($criteria);
		
		$criteria->with = array(
				'baseUser'
		);
		$users = Administrators::model()->findAll($criteria);
		
		$this->getController()->addToSubNav('添加管理员','user/add');
		$this->pageTitle = '查看管理员';
		$this->render('view',array('users'=>$users,'pager'=>$pager));
	}
}