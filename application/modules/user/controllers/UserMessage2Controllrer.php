<?php
class UserMessageController extends SqbController{
	public function filters(){
		return array();
	}

	public function actionIndex(){
		$criteria = new CDbCriteria;
		$criteria->select = "id,uid,add_time";
		$criteria ->order = 'add_time DESC';
		$criteria->with = array(
					'UserMessage'=>array('select'=>'nickname')
				);
		$messageData = MessageBoard::model()->findAll($criteria);
		var_dump($messageData);
		die();
		$this->pageTitle = '反馈管理';
		$this->render('index',array('messageData'=>$messageData,));

	}

	public function init(){
		parent::init();

		//$phpsessid = $this->getPost();
		if(isset($_POST['PHPSESSID']))
			session_id($_POST['PHPSESSID']);

	}
}
	

?>