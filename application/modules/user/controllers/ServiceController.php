<?php
/**
 * @name ServiceController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-31
 * Encoding UTF-8
 */
class ServiceController extends CmsController{
	
	public $actionClassPathAlias = 'application.modules.user.controllers';
	
	public function getActionClass(){
		return array(
				'create' => array('class' => 'createUser'),
				'update' => array('class' => 'updateUser'),
				'createAddress' => array('class' => 'createUserAddress'),
				'updateAddress' => array('class' => 'updateUserAddress'),
				'getAddress' => array('class' => 'getUserAddress'),
				'getBind' => array('class' => 'getUserBindInfo'),
				'getCommunity',
				'createFamilyMember',
				'getFamilyInvitation',
				'createFamilyConfirm' => array('class'=>'familyConfirm')
		);
	}
	
	public function filters(){
		$filters = parent::filters();
		$filters['hasLogined'][0] = $filters['hasLogined'][0].' - create,login';
		
		return $filters;
	}
	
	public function actionLogin(){
		if ( $this->app->getUser()->getIsGuest() ){
			$model = new SqbLoginForm('app');
			$model->attributes = $this->getRestParam();
			
			if ( $model->login(3600*24*30) ){
				$this->response(100,'登录成功',$model->getIdentity()->getReturnStates());
			}else {
				$this->response(102,'登录失败',$model->getErrors());
			}
		}else {
			$this->response(103,'请不要重复登录');
		}
	}
	
	public function actionLogout(){
		$this->app->getUser()->logout();
		$this->response(101,'退出成功');
	}
	
	public function loginRequired(){
		$this->response(400,'请登录');
	}

	public function actionGetCloseUser($uid,$lag,$lng){ //获取附近用户
		if(!empty($uid) && !empty($lag) && !empty($lng)){
			$userPlaceclean = $this->app->UserManager->cleanMypleace($uid);
			if($userPlaceclean == 200){
				$userAdd = $this->app->UserManager->addCloseUser($uid,$lag,$lng);
				if($userAdd == 200){
					$closeUserData = $this->app->UserManager->getCloseUser($lag,$lng,$uid);
					if($closeUserData == 300)
						$this->response(300,'','附近无用户');
					else
						$this->response(200,'',$closeUserData);
				}
				
				else
					$this->response(400,'',$userAdd);
			}

			elseif($userPlaceclean == 300){
				$userAdd = $this->app->UserManager->addCloseUser($uid,$lag,$lng);
				if($userAdd == 200){
					$closeUserData = $this->app->UserManager->getCloseUser($lag,$lng,$uid);
					if($closeUserData == 300)
						$this->response(300,'','附近无用户');
					else
						$this->response(200,'',$closeUserData);
				}
				
				else
					$this->response(400,'',$userAdd);
			}	
		}else
			$this->response(101,'','无参数');		
	}

	public function actionCleanMypleace($uid){ //清除用户位置信息
		if(!empty($uid) && is_numeric($uid)){
			$cleanUserPleace = $this->app->UserManager->cleanMypleace($uid);
			if($cleanUserPleace == 200)
				$this->response(200,'','删除成功');
			else if($cleanUserPleace == 300)
				$this->response(300,'','该用户无位置信息');
			else
				$this->response(400,'','发生错误');
		}
	}

	public function actionCreateMessage($uid,$content){
		if(!empty($uid) && !empty($content) && is_numeric($uid)){
			$messageAdd = $this->app->UserManager->messageAdd($uid,$content);
			if($messageAdd == 200)
				$this->response(200,'','反馈添加成功');
			else
				$this->response(400,'','发生错误');
		}
	}
}