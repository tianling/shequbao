<?php

class UserMessageController extends SqbController
{
	public function init(){
		parent::init();

		//$phpsessid = $this->getPost();
		if(isset($_POST['PHPSESSID']))
			session_id($_POST['PHPSESSID']);

	}
	
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->select = "id,uid,add_time,content";
		$criteria ->order = 'add_time DESC';
		$criteria->with = array(
					'UserMessage'=>array('select'=>'nickname'),
				);
		$count = MessageBoard::model()->count($criteria);
		$pager = new CPagination($count);
		$pager->pageSize = 50;
		$pager->applyLimit($criteria);
		
		$messageData = MessageBoard::model()->findAll($criteria);
		if(!empty($messageData)){
			foreach($messageData as $key =>$value){
				$nickname = $value->getRelated('UserMessage');
				$username = $nickname->nickname;

				$messageInfo[] = array(
							'nickname'=>$username,
							'id'=>$value->id,
							'content' => $value->content,
							'add_time'=>$value->add_time,
							'ip' => $value->add_ip,
						);
				
			}
		}
		$this->pageTitle = '反馈管理';

		$this->render('index',array('messageData'=>$messageInfo,'count'=>$count));

	}

	public function actionView($id){
		if(!empty($id) && is_numeric($id)){
			
			$messageData = MessageBoard::model()->with('UserMessage')->findByPk($id);
			if(!empty($messageData)){	
				$this->pageTitle = '反馈查看';
				$this->render('view',array('messageData'=>$messageData));
			}
		}
	}
	
	
	
	public function actionCreate()
	{
		$model=new MessageBoard;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MessageBoard']))
		{
			$model->attributes=$_POST['MessageBoard'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
=======
		$this->render('index',array('messages'=>$messageInfo,'pager'=>$pager));


	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(isset($id) && is_numeric($id)){
			$messageData = MessageBoard::model()->deleteByPk($id);
		}
		$this->showMessage('删除成功','userMessage/index');
	}
	
	public function actionReply(){
		$id = $this->getQuery('id',null);
		if ( $id === null ){
			$this->redirect($this->createUrl('userMessage/index'));
		}
		$model = new PushMessageForm();
		$post = $this->getPost('PushMessageForm',null);
		
		if ( $post !== null ){
			$model->attributes = $post;
			if ( $model->validate() ){
				$message = MessageBoard::model()->findByPk($id);
				if ( $message === null ){
					$this->showMessage('参数错误','userMessage/index');
				}
				
				$sendTo = 'user'.$message->uid;
				$extras = array(5,0,$sendTo,time());
				$extras['ios'] = array(
						'badge' => 1,
						'sound' => 'happy'
				);
				$chatManager = $this->app->getModule('friends')->getChatManager();
				$chatManager->getPusher()->setTimeToLive(864000);
				
				$title = '社区宝物管回复：'.$model->title;
				$result = $chatManager->pushNotification(1,$sendTo,1,$model->content,$title,$extras);
				if ( $result->hasError === false ){
					$this->showMessage('回复成功','userMessage/index');
				}else {
					$model->addError('content','回复失败');
				}
			}
		}
		
		$this->pageTitle = '推送消息';
		$form = $this->getPushForm($model);
		$this->render('pushMessage',array('form'=>$form));
	}
	
	public function getPushForm($model){
		$config = array(
				'elements' => array(
						'title' => array(
								'type' => 'text',
								'label' => '消息标题',
								'class' => 'form-input-text'
						),
						'content' => array(
								'type' => 'textarea',
								'label' => '消息内容',
								'class' => 'form-input-textarea',
								'placeholder' => '80字以内',
								'maxLength' => 80
						)
				),
				'buttons' => array(
						'submit' => array(
								'type' => 'submit',
								'label' => '发送',
								'class' => 'form-button form-button-submit'
						)
				)
		);
	
		return new CForm($config,$model);
	}
}
