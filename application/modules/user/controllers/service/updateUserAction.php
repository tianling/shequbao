<?php
/**
 * @author lancelot <cja.china@gmail.com>
 * Date 2013-9-9
 * Encoding GBK 
 */
class updateUserAction extends CmsAction{
	public function run($id){
		$loginId = $this->app->user->id;
		$user  = SqbUser::model()->with('baseUser')->findByPk($id);
		
		if($user!=null){
			if ($loginId==$id) {
				$putData = $this->getController()->getRestParam();
		
				$user->setScenario('appUpdate');
				$oldAttributes = $user->getAttributes();
				$user->setAttributes($putData);
				if($user->validate()){
					if ( isset($putData['password']) ){
						$user->baseUser->changePassword($putData['password']);
					}
					$user->baseUser->changeUUID($putData,$oldAttributes,$oldAttributes);
						
					$user->save(false);
					$this->response(200,'修改成功');
				}else{
					$this->response(400,$user->getErrors());
				}
			}
			else{
				$this->response(400,'不能修改他人信息');
			}
		}else{
			$this->response(404,'用戶不存在');
		}
	}
}