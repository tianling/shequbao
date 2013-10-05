<?php

class UserMessageController extends SqbController
{
	public function init(){
		parent::init();

		//$phpsessid = $this->getPost();
		if(isset($_POST['PHPSESSID']))
			session_id($_POST['PHPSESSID']);

	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->select = "id,uid,add_time";
		$criteria ->order = 'add_time DESC';
		$criteria->with = array(
					'UserMessage'=>array('select'=>'nickname'),
				);
		$count = MessageBoard::model()->count($criteria);
		$page=new CPagination($count);
		$page->pageSize=16;
		$page->applyLimit($criteria);
		$messageData = MessageBoard::model()->findAll($criteria);
		$this->pageTitle = '反馈管理';
		$this->render('index',array('messageData'=>$messageData,'pages'=>$page));

	}

	public function actionView($id){
		if(!empty($id) && is_numeric($id)){
			$messageData = MessageBoard::model()->findByPk($id);
			if(!empty($messageData)){
				$content = $messageData->content;
			}
		}
		$this->pageTitle = '反馈查看';
		$this->render('view',array('content'=>$content));
	}

	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
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

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MessageBoard']))
		{
			$model->attributes=$_POST['MessageBoard'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(isset($id) && is_numeric($id)){
			$messageData = MessageBoard::model()->findByPk($id);
			if(!empty($messageData)){
				$dataM = $messageData->delete();
				if($dataM>0)
					$this->showMessage('删除成功','usermessage/index');
			}

		}
		$this->redirect(Yii::app()->createUrl('admin/UserMessage/index'));	

	}

	/**
	 * Lists all models.
	 */
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MessageBoard('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MessageBoard']))
			$model->attributes=$_GET['MessageBoard'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MessageBoard the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MessageBoard::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MessageBoard $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-board-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
