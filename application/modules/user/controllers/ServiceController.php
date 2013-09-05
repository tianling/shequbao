<?php
/**
 * @name ServiceController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-31
 * Encoding UTF-8
 */
class ServiceController extends CmsController{
	
	public function filters(){
		$filters = parent::filters();
		$filters['hasLogined'][0] = $filters['hasLogined'][0].' - create,login';
		
		return $filters;
	}
	
	public function actionCreate(){
		if ( Yii::app()->getUser()->getIsGuest() ){
			$user = new SqbUser();
			$attributes = $this->getPost();
			$attributes['last_login_time'] = time();
			$attributes['last_login_ip'] = $this->request->userHostAddress;
			
			$user->attributes = $attributes;
			
			if ( $user->validate() ){
				$user->save(false);
				$this->response(200,'注册成功');
			}else {
				$this->response(400,$user->getErrors());
			}
		}else {
			$this->response(200,'请退出之后注册');
		}
		
	}
	
	public function actionLogin(){
		if ( Yii::app()->getUser()->getIsGuest() ){
			$model = new SqbLoginForm('app');
			$model->attributes = $this->getRestParam();
			
			if ( $model->login(3600*24*30) ){
				$this->response(200,'登录成功');
			}else {
				$this->response(200,'登录失败',$model->getErrors());
			}
		}else {
			$this->response(200,'请不要重复登录');
		}
	}
	
	public function actionLogout(){
		Yii::app()->getUser()->logout();
		$this->response(200,'退出成功');
	}
	
	public  function actionUpdate($id){
		$user = new SqbUser();
		$loginId = Yii::app()->user->id;
		$user  = SqbUser::model()->with('baseUser')->findByPk($id);
		
		if($user!=null){
			if ($loginId==$id) {
				$putData = $this->getRestParam();
				
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
	
	public function loginRequired(){
		$this->response(200,'请登录');
	}
	
	public function actionCreateAddress($id){
			$address = new UserAddress();
			$newAttributes = $this->getPost();
			$newAttributes['user_id'] = $id;
			$address->attributes = $newAttributes;
			if($address->save()){
				$this->response(200,'增加成功');
			}else{
				print_r($address->getErrors());
				$this->response(400,'增加失败');
			}
	}
	
	
 	public function actionUpdateAddress($address_id){
	 	$address = new UserAddress();
	 	$address =UserAddress::model()->findByPk($address_id);
	 	$userid=$address->user_id;
		$loginId = Yii::app()->user->id;
		if($loginId==$userid){
			$address=$this->getPost();
			if($address->save()){
				$this->response(200,'修改成功');
			}else{
				print_r($address->getErrors());
				$this->response(400,'修改失败');
			}
		}else{
			$this->request(404,'用户不存在');
		}
	
	
	}  
}