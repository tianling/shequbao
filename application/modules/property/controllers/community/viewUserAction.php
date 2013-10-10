<?php
/**
 * @name viewUserAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class viewUserAction extends CmsAction{
	public function run(){
		$communityId = $this->getQuery('community',null);
		if ( $communityId === null ){
			$this->redirect($this->createUrl('community/view'));
		}
		$propertyId = $this->app->user->getState('property_id');
		$propertyId = 1;
		if ( $propertyId === null ){
			$this->getController()->showMessage('您不是物管公司成员，不能操作','/site/welcome');
		}
		
		$exist = PropertyCommunity::model()->exists('property_id=:pid AND community_id=:cid',array(':pid'=>$propertyId,':cid'=>$communityId));
		if ( $exist === false ){
			$this->getController()->showMessage('您无权向该小区推送','/site/welcome');
		}
		
		$data = array();
		$criteria = new CDbCriteria();
		$criteria->condition = 'community_id=:cid';
		$criteria->params[':cid'] = $communityId;
		$model = CommunityUser::model();
		
		$count = $model->count($criteria);
		if ( $count !== 0 ){
			$criteria->with = array(
					'user' => array(
							'select' => 'id,nickname'
					)
			);
			$data = $model->findAll($criteria);
		}
		
		$this->pageTitle = '小区用户';
		$this->render('viewUser',array('list'=>$data));
	}
}