<?php

class UserChargeController extends SqbController
{
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{	
		if(!empty($id) && is_numeric($id)){
			$model=new UserChargeInfo;
			if(isset($_POST['UserChargeInfo']))
			{
				$model->attributes=$_POST['UserChargeInfo'];
				$model->uid = $id;
				$model->add_time = time();
				if($model->save())
					$this->redirect(array('index','id'=>$model->uid));
			}
			$this->pageTitle = '欠费添加';
			$this->render('create',array(
				'model'=>$model,
			));	

		}
	}


	public function actionDelete($id,$uid)
	{
		if(!empty($id) && is_numeric($id)){
			$this->loadModel($id)->delete();
		}
		$this->redirect(array('index','id'=>$uid));	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		if(!empty($id) && is_numeric($id)){

			$waterFee = 0;
			$electricityFee = 0;
			$gasFee = 0;
			$garbageFee = 0;

			$userAddressData = UserAddress::model()->findAll('user_id =:id',array(':id'=>$id));
			if(!empty($userAddressData)){
				$criteria = new CDbCriteria;
				$criteria->select = "id,uid,add_time,type,charge";
				$criteria->condition = 'uid = '.$id.'';
				$criteria ->order = 'add_time DESC';
				$count = UserChargeInfo::model()->count($criteria);
				$page=new CPagination($count);
				$page->pageSize=11;
				$page->applyLimit($criteria);
				$ChargeData = UserChargeInfo::model()->findAll($criteria);
				if(!empty($ChargeData)){
						$this->pageTitle = '缴费查询';	
						$this->render('index',array(
						'ChargeData'=>$ChargeData,
						'pages'=>$page,
						'type'=>1
					));
				}else{
					foreach($ChargeData as $value){
						$waterFee += $this->app->UserManager->getChargeinfo($value->water,0);
						$electricityFee += $this->app->UserManager->getChargeinfo($value->electricity,1);
						$gasFee += $this->app->UserManager->getChargeinfo($value->gas,2);
						$garbageFee += $this->app->UserManager->getChargeinfo($value->garbage,3);

					}
					$this->pageTitle = '缴费查询';
					$this->render('index',array(
												"waterFee"=>$waterFee,
												"electricityFee"=>$electricityFee,
												"gasFee"=>$gasFee,
												"garbageFee"=>$garbageFee,
												"type"=>2

											));
				}

			}else{
				$this->pageTitle = '缴费查询';
				$this->render('index',array(
											"data"=>"该用户无房产",
											"type"=>3

										));
			}
					
		}

		$this->pageTitle = '缴费查询';	
			
	}

	
	public function loadModel($id)
	{
		$model=UserChargeInfo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-charge-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
