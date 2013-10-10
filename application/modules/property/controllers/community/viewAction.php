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
		$propertyId = $this->app->user->getState('property_id');
		if ( $propertyId === null ){
			$this->getController()->showMessage('您不是物管公司成员，不能操作','/site/welcome');
		}
		$model = PropertyCommunity::model();
		$criteria = new CDbCriteria();
		$data = array();
		$pager = null;
		
		$criteria->condition = 'property_id=:proid';
		$criteria->params = array(
				':proid' => $propertyId
		);
		
		$count = $model->count($criteria);
		if ( $count !== 0 ){
			$pager = new CPagination($count);
			$pager->pageSize = 16;
			$pager->applyLimit($criteria);
			$criteria->with = array(
					'community' => array(
							'alias' => 'com',
							'select' => 'com.id,location,community_name',
							'with' => array(
									'area'
							)
					)
			);
			$data = $model->findAll($criteria);
		}
		
		$this->pageTitle = '小区管理';
		$this->getController()->addToSubNav('添加管理小区','community/add');
		$this->render('view',array('communityData'=>$data,'pages'=>$pager));
	}
}