<?php
/**
 * @name UserController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
class UserController extends SqbController{
	public $defaultAction = 'view';
	public $actionClassPathAlias = 'sqbadmin.controllers';
	
	public function getActionClass(){
		return array(
				'add',
				'edit',
				'view',
				'delete'
		);
	}
	
	public function getForm($model){
		$config = array(
				'elements' => array(
						'surname' => array(
								'type' => 'text',
								'label' => '姓氏',
								'class' => 'form-input-text'
						),
						'name' => array(
								'type' => 'text',
								'label' => '名字',
								'class' => 'form-input-text'
						),
						'nickname' => array(
								'type' => 'text',
								'label' => '昵称',
								'class' => 'form-input-text',
								'required' => true,
						),
						'password' => array(
								'type' => 'password',
								'label' => '密码',
								'class' => 'form-input-text',
								'required' => true,
						),
						'phone' => array(
								'type' => 'text',
								'label' => '手机号',
								'class' => 'form-input-text'
						),
						'email' => array(
								'type' => 'text',
								'label' => '邮箱',
								'class' => 'form-input-text'
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