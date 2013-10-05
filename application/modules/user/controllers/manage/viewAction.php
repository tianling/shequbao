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
		$criteria->with = array(
				'baseUser' => array(
						'alias' => 'baseUser'
				)
		);
		
		$search = $this->getQuery('searchUser',null);
		$keyword = '';
		if ( $search !== null ){
			$keyword = $search['nickname'];
			$criteria->addSearchCondition('baseUser.nickname', $keyword);
		}
		
		$count = $model->count($criteria);
		$pager = new CPagination($count);
		$pager->pageSize = 30;
		$pager->applyLimit($criteria);
		
		
		$data = $model->findAll($criteria);
		
		$this->getController()->addToSubNav('添加用户','manage/add');
		$this->getController()->addToSubNav('批量添加用户','manage/addMulti');
		$this->setPageTitle('用户列表');
		$this->render('view',array('list' => $data,'pager'=>$pager ,'keyword'=>$keyword));
	}
}