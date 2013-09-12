<?php
/**
 * @name getUserBindInfoAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-11
 * Encoding UTF-8
 */
class getUserBindInfoAction extends CmsAction{
	public function run($resourceId){
		$user = Yii::app()->getUser();
		if ( $resourceId !== $user->getId() ){
			$this->response(403,'用户ID不匹配');
		}
		$data = UserModel::getUserRelationInfo($resourceId);
		$this->response(200,'',$data);
	}
}