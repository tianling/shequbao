<?php
/**
 * @name userDeleteAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class userDeleteAction extends CmsAction{
	public function run(){
		$id = $this->getQuery('id',null);
		if ( $id === null ){
			$this->redirect($this->createUrl('property/userView'));
		}
		
		PropertyAdmin::model()->deleteByPk($id);
		$this->getController()->showMessage('删除成功','property/userView');
	}
}