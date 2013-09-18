<?php
/**
 * @name FrontUserManager.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-18
 * Encoding UTF-8
 */
class FrontUserManager extends BaseUserManager{
	public function init(){
		Yii::import('user.models.*');
	}
	
	public function findAll($criteria=null,$params=array()){
		return SqbUser::model()->findAll($criteria,$params);
	}
	
	public function count($criteria=null,$params=array()){
		return SqbUser::model()->count($criteria,$params);
	}
}