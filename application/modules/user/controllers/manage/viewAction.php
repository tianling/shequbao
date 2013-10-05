<?php
/**
 * @name viewAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-6
 * Encoding UTF-8
 */
class viewAction extends CmsAction{
	public function run(){
		$model = SqbUser::model();
		$data = array();
		
		$criteria = new CDbCriteria();
		$count = $model->count();
		$pager = new CPagination($count);
		$pager->pageSize = 20;
		$pager->applyLimit($criteria);
		
		$criteria->with = array(
				'baseUser'
		);
		$data = $model->findAll($criteria);
		
		$this->getController()->addToSubNav('添加用户','manage/add');
		$this->setPageTitle('用户列表');
		$this->render('view',array('list' => $data,'pager'=>$pager));
	}
}