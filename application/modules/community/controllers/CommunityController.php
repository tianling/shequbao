<?php

class CommunityController extends SqbController
{
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	public function actionIndex(){
		$id = Yii::app()->user->id;

		$criteria = new CDbCriteria;
		$criteria->alias = 'com';
		$criteria ->select = 'com.id,location,community_name';
		$criteria ->order = 'com.id DESC';
		
		$count = Community::model()->count($criteria);
		$page=new CPagination($count);
		$page->pageSize=16;
		$page->applyLimit($criteria);

		$criteria->with = array(
				'area' => array(
						'alias' => 'area'
				)
		);
		$communityData = Community::model()->findAll($criteria);
		
		$this->pageTitle = '小区管理';
		$this->render('index',array('communityData'=>$communityData,'pages'=>$page));
	}

	
	public function actionCreate()//小区添加
	{
		$model=new Community;

		if(isset($_POST['Community']))
		{
			$model->attributes=$_POST['Community'];
			if($model->save()){	
				$chatRoomModel = new ChatRoom;
				$chatRoomModel->community_id = $model->id;
				$chatRoomModel->room_name = $model->community_name;
				if($chatRoomModel->save())			
					$this->redirect(Yii::app()->createUrl('ad/community/index'));
			}
				
			
			else
				var_dump($model->getErrors());
		}
		$area = Area::model()->findAll('fid =:id',array(':id'=>2449));
		$areaData =  CHtml::listData($area,'id', 'area_name'); 
		$this->pageTitle = '小区添加';
		$this->render('create',array(
			'model'=>$model,
			'areaData'=>$areaData
		));
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$area = Area::model()->findAll('fid =:id',array(':id'=>2449));
		$areaData =  CHtml::listData($area,'id', 'area_name'); 
		if(isset($_POST['Community']))
		{
			$model->attributes=$_POST['Community'];
			if($model->save())
				$this->redirect(Yii::app()->createUrl('ad/community/index'));
			else
				$this->redirect(Yii::app()->createUrl('site/index'));
		}

		$this->pageTitle = '信息修改';
		$this->render('update',array(
			'model'=>$model,
			'areaData'=>$areaData,
		));
	}

	
	public function actionDelete($id)
	{
		if(!empty($id) && is_numeric($id)){
			$communityData = Community::model()->findByPk($id);
			if(!empty($communityData)){
				$communityData->delete();
				$this->redirect(Yii::app()->createUrl('ad/community/index'));

			}
		}	
	}



	public function loadModel($id)
	{
		$model=Community::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='community-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
