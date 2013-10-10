<?php
/**
 * @name userViewAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class userViewAction extends CmsAction{
	public function run(){
		$model = PropertyAdmin::model();
		$criteria = new CDbCriteria();
		
		$count = $model->count($criteria);
		$pager = new CPagination($count);
		$pager->pageSize = 50;
		$pager->applyLimit($criteria);
		
		$criteria->with = array(
				'property',
				'baseUser' => array(
						'select' => 'nickname'
				),
		);
		$data = $model->findAll($criteria);
		
		$this->getController()->addToSubNav('添加物管管理员','property/userAdd');
		$this->pageTitle = '物管管理员列表';
		$this->render('userView',array('list'=>$data,'pager'=>$pager));
	}
}