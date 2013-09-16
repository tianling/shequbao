<?php
class AdvertiseController extends CmsController
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin',),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria ->select = 'id,advertiser_id,title';
		$criteria ->order = 'id DESC';
		$advertiseData = Advertise::model()->findAll($criteria);
		$this->render('index',array('advertiseData'=>$advertiseData));

	}

	public function actionCreate()
	{
		$model = new Advertise;
		if(isset($_POST['Advertise'])){
			$model->attributes = $_POST['Advertise'];
			if($model->save())
			{
				echo "ok";
			}else{
			var_dump($model->getErrors());
			}
		}
		$this->render('create',array('model'=>$model));

	}

	public function actionUpdate($id)
	{
		if(!empty($id) && is_numeric($id)){
			$model=$this->loadModel($id);
			if(isset($_POST['Advertise'])){
				$model->attributes=$_POST['Advertise'];
				if($model->save())
					echo "ok";
			}
			$this->render('update',array('model'=>$model));
			
			
		}
	}
	
	public function loadModel($id)
	{
		$model=Advertise::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
?>