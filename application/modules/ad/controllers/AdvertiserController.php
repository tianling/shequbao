<?php

class AdvertiserController extends SqbController
{
	public function init(){
		parent::init();
		if(isset($_POST['PHPSESSID']))
			session_id($_POST['PHPSESSID']);
	
	}
	
	public function actionindex()
	{
		$criteria = new CDbCriteria;
		$count=Advertiser::model()->count($criteria);
		
		$page=new CPagination($count);
		$page->pageSize=16;
		$page->applyLimit($criteria);
		
		$criteria->with = array(
				'baseUser'=>array(
						'select'=>'nickname',
				),
		);
		
		$advertiserData = Advertiser::model()->findAll($criteria);
		
		$this->addToSubNav('添加广告主','advertiser/create');
		$this->pageTitle = '广告主管理';
		$this->render('index',array('advertiserData'=>$advertiserData,'pages'=>$page));
	}
	
	public function actionCreate()
	{
		$model=new Advertiser();
		
		if(isset($_POST['Advertiser']))
		{
			$_POST['Advertiser']['last_login_ip'] = 'N/A';
			$_POST['Advertiser']['last_login_time'] = time();
			$model->attributes=$_POST['Advertiser'];
			if($model->save()){
				$this->showMessage('添加成功','advertiser/index');
			}
		}
		
		$form = $this->getForm($model);
		$this->pageTitle = '添加广告主';
		$this->render('create',array('form'=>$form));
	}
	
	public function actionUpdate()
	{
		$id = $this->getQuery('id',null);
		if ( $id === null ){
			$this->redirect($this->createUrl('advertiser/index'));
		}
		
		$model  = Advertiser::model()->with('baseUser')->findByPk($id);
		if ( $model === null ){
			$this->redirect($this->createUrl('advertiser/index'));
		}
		
		$post = $this->getPost('Advertiser',null);
		if( $post !== null )
		{
			$model->attributes=$post;
			
			if( $model->validate() ){
				if ( isset($post['password']) && !empty($post['password']) ){
					$model->baseUser->changePassword($_POST['Advertiser']);
				}
				
				$model->save(false);
				$this->showMessage('修改成功','advertiser/index');
			}
				
		}
		
		$model->password = '';
		$form = $this->getForm($model);
		$this->pageTitle = '编辑广告主';
		$this->render('create',array('form'=>$form));
	}
	
	public function actionDelete($id)
	{
		if(!empty($id) && is_numeric($id)){
			$userData = Advertiser::model()->findByPk($id);
			if( $userData !== null ){
				$userData->delete();
			}
		}
		$this->redirect($this->createUrl('advertiser/index'));	
	}
	
	public function getForm($model){
		$config = array(
				'elements' => array(
						'nickname' => array(
								'type' => 'text',
								'label' => '昵称',
								'class' => 'form-input-text',
								'required' => true
						),
						'password' => array(
								'type' => 'password',
								'label' => '密码',
								'class' => 'form-input-text',
								'required' => true
						),
						'phone' => array(
								'type' => 'text',
								'label' => '电话',
								'class' => 'form-input-text'
						),
						'email' => array(
								'type' => 'text',
								'label' => '邮箱',
								'class' => 'form-input-text'
						),
						'balance' => array(
								'type' => 'text',
								'label' => '余额',
								'class' => 'form-input-text',
						),
				),
				'buttons' => array(
						'submit' => array(
								'type' => 'submit',
								'label' => '确定',
								'class' => 'form-button form-button-submit'
						)
				)
		);
		
		return new CForm($config,$model);
	}
}
