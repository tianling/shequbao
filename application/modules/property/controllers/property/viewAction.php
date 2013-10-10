<?php
/**
 * @name viewAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class viewAction extends CmsAction{
	public function run(){
		$model = Property::model();
		$criteria = new CDbCriteria();
		
		$count = $model->count($criteria);
		$pager = new CPagination($count);
		$pager->pageSize = 30;
		$pager->applyLimit($criteria);
		
		$data = $model->findAll($criteria);
		$this->pageTitle = '查看物管';
		$this->render('view',array('list' => $data));
	}
}