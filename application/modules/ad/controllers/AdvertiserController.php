<?php

class AdvertiserController extends SqbController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	

	/**
	 * @return array action filters
	 */

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionindex()
	{
		$criteria = new CDbCriteria;
		$criteria->select = "advertiser_id,phone,email,balance,ads";
		$criteria ->order = 'advertiser_id DESC';
		$criteria->with = array(
						'baseUser'=>array(
								'select'=>'nickname',
							),
					);
		$count=Advertiser::model()->count($criteria);
		$page=new CPagination($count);
		$page->pageSize=16;
		$page->applyLimit($criteria);
		$advertiserData = Advertiser::model()->findAll($criteria);
		//var_dump($advertiserData);
		//die();
		$this->pageTitle = '广告主管理';
		$this->render('index',array('advertiserData'=>$advertiserData,'pages'=>$page));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Advertiser;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Advertiser']))
		{
			$model->attributes=$_POST['Advertiser'];
			if($model->save()){
				$this->redirect(Yii::app()->createUrl('ad/advertiser/index'));
				
			}else {
				return 400;
			}
		}
		$this->pageTitle = '广告主添加';
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
		if(!empty($id)  && is_numeric($id)){
			$model  = Advertiser::model()->with('baseUser')->findByPk($id);
			if(isset($_POST['Advertiser']))
			{
				$model->attributes=$_POST['Advertiser'];
				$new_password = $model->password;
				$model->baseUser->changePassword($new_password);
				if($model->save())
					$this->redirect(Yii::app()->createUrl('ad/advertiser/index'));
			}
		}else
			$this->redirect(Yii::app()->createUrl('ad/advertiser/index'));
		$this->pageTitle = '信息修改';
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
		if(!empty($id) && is_numeric($id)){
			$userData = UserModel::model()->findByPk($id);
			if(!empty($userData)){
				$userData->delete();
			}
			
		}
		$this->redirect(Yii::app()->createUrl('ad/advertiser/index'));	
	}


	public function actionBalanceAdd($id)
	{
		if(!empty($id) && is_numeric($id)){
			$advertiserData = Advertiser::model()->findByPk($id);
			if(!empty($advertiserData)){
				$Balance = $advertiserData->balance;
			}
		}
		if(isset($_POST['balance'])){
			echo "dfdf";
			die();
			$Balance+=$_POST['balance']['balance_add'];
			$advertiserData->balance = $Balance;
			if($advertiserData->save())
				$this->redirect(Yii::app()->createUrl('ad/advertiser/index'));	
		}
		$this->pageTitle = '充值';
		$this->render('balanceAdd',array(
			'balance'=>$Balance,
			'id'=>$id,
		));

	}

	/**
	 * Lists all models.
	 */
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Advertiser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Advertiser']))
			$model->attributes=$_GET['Advertiser'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Advertiser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Advertiser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Advertiser $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='advertiser-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function init(){
		parent::init();

		//$phpsessid = $this->getPost();
		if(isset($_POST['PHPSESSID']))
			session_id($_POST['PHPSESSID']);

	}
}
