<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-9
 * Encoding GBK 
 */
class updateUserAddressAction extends CmsAction{
	public function run($resourceId,$id){
		$address =UserAddress::model()->findByPk($id);
		$uid = $address->user_id;
		$loginId = $this->app->user->id;
		if( $resourceId === $loginId && $loginId == $uid){
			$address->setScenario('appUpdate');
			$address->attributes = $this->getRestParam();
			if($address->save()){
				$this->response(200,'修改成功');
			}else{
				$this->response(201,'修改失败',$address->getErrors());
			}
		}else{
			$this->request(202,'用户不存在');
		}
	}
}