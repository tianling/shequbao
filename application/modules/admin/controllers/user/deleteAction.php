<?php
/**
 * @name deleteAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
class deleteAction extends CmsAction{
	public function run(){
		$id = $this->getQuery('id',null);
		if ( $id === null )
			$this->redirect($this->createUrl('user/view'));
		
		Administrators::model()->deleteByPk($id);
		
		$this->getController()->showMessage('删除成功','user/view');
	}
}