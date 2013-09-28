<?php
/**
 * @name FrontUserManager.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-18
 * Encoding UTF-8
 */
class FrontUserManager extends BaseUserManager{
	/**
	 * 
	 * @var SqbUser
	 */
	public $model;
	
	public function init(){
		Yii::import('user.models.*');
		$this->model = SqbUser::model();
	}
	
	public function findAll($criteria=null,$params=array()){
		return $this->model->findAll($criteria,$params);
	}
	
	public function findByPk($pk,$criteria=null,$params=array()){
		return $this->model->findByPk($pk,$criteria,$params);
	}
	
	public function count($criteria=null,$params=array()){
		return $this->model->count($criteria,$params);
	}

	public function addCloseUser($uid,$lat,$lng){
		if(!empty($uid) && !empty($lat) && !empty($lng) ){
			$CloseUserModel = new CloseUser;
			$CloseUserModel->coord_x = $lat;
			$CloseUserModel->coord_y = $lng;
			$CloseUserModel->uid = $uid;
			$CloseUserModel->time = time();
			if($CloseUserModel->save())
				return 200;
			else{
				$error = $CloseUserModel->getErrors();
				return $error;
			}
				//return 400;
			
		}
	}
}