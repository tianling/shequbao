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
		
		$searchModel = new SearchUserForm();
		$search = $this->getQuery('SearchUserForm',null);
		$data = array();
		$criteria = new CDbCriteria();
		$criteria->condition = 'community_id=:cid';
		$criteria->params[':cid'] = $communityId;
		$criteria->with = array(
				'user' => array(
						'alias' => 'front',
						'select' => 'front.id,front.mobile',
				)
		);
		$model = CommunityUser::model();
		
		if ( $search !== null ){
			$searchModel->attributes = $search;
			if ( $searchModel->validate() ){
				$criteria->addSearchCondition('front.mobile',$searchModel->keyword);
			}
		}
		
		$count = $model->count($criteria);
		if ( $count !== 0 ){
			$criteria->with['user']['with'] = array(
						'baseUser' => array(
								'select' => 'nickname'
						)
			);
			$data = $model->findAll($criteria);
		}
		
		$searchFormConfig = array(
				'elements' => array(
						'keyword' => array(
								'type' => 'text',
								'label' => '用户手机号',
								'class' => 'form-input-text'
						)
				),
				'buttons' => array(
						'submit' => array(
								'type' => 'submit',
								'label' => '搜索',
								'class' => 'form-button'
						)
				)
		);
		$form = new CForm($searchFormConfig,$searchModel);
		$form->method = 'get';
		$this->pageTitle = '小区用户';
		$this->render('viewUser',array('list'=>$data,'form'=>$form));
	}
}