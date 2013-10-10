<?php
/**
 * @name deleteAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class deleteAction extends CmsAction{
	public function run(){
		$propertyId = $this->app->user->getState('property_id');
		
		if ( $propertyId === null ){
			$this->getController()->showMessage('您不是物管公司成员，不能操作','/site/welcome');
		}
		
		$id = $this->getQuery('id',null);
		if ( $id === null ){
			$this->redirect($this->createUrl('community/view'));
		}
		
		$condition = 'community_id=:cid AND property_id=:pid';
		$params = array(
				':pid' => $propertyId,
				':cid' => $id
		);
		$pass = PropertyCommunity::model()->find($condition,$params);
		if ( $pass === null ){
			$this->getController()->showMessage('您无权删除这个小区','/site/welcome');
		}
		
		Community::model()->deleteByPk($id);
		$this->getController()->showMessage('删除成功','community/view');
	}
}