<?php
/**
 * @name ServiceController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-8-31
 * Encoding UTF-8
 */
class ServiceController extends CmsController{
	
	public function actionSignUp(){
		$user = new SqbUser();
		$attributes = $this->getPost();
		$attributes['last_login_time'] = time();
		$attributes['last_login_ip'] = $this->request->userHostAddress;
		
		$user->attributes = $attributes;
		
		if ( $user->save() ){
			$this->response(200,'注册成功');
		}else {
			$this->response(400,$user->getErrors());
		}
	}
	
	public function actionLogin(){
		$model = new SqbLoginForm('app');
		$model->attributes = $this->getPost();
		
		if ( $model->login() ){
			$this->response(200,'登录成功');
		}else {
			$this->response(400,'登录失败',$model->getErrors());
		}
	}
	
	public  function actionUpdateUser($id){
		$user = new SqbUser();
		$loginId = Yii::app()->user->id;
		$user  = SqbUser::model()->with('baseUser')->findByPk($id);
		if($user!=null){
			if ($loginId==$id) {
				$user->attributes = $this->getRestParam();
				if($user->save()){
					$this->response(200,'修改成功');
				}else{
					//if save() fail
					$this->response(405,$user->getErrors());
				}
			}else{
				//if the $loginId!=$user_id
				$this->response(404,'用户名存在');
			}
		}else{
			//if the $user is null
			$this->response(404,'用戶名不存在');
				
		}
	}
	
	/* 	public function actionUpdateUserAddress($user_id){
	 $address = new UserAddress();
	$loginId = Yii::app()->user->id;
	$model =  UserAddress::model()->find('user_id=:user_id',array(':user_id'=>$user_id));
	if($loginId==$user_id)
	{
	$address->attributes = $this->getPost();
	if($model->save()){
	$this->response(200,'成功');
	}else{
	$this->reponse(404,$address->getErrors());
	}
	}else{
	$this->response(404,'用户名不存在');
	}
	
	} */
}