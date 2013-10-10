<?php
/**
 * @name PropertyController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class PropertyController extends SqbController{
	public $actionClassPathAlias = 'property.controllers';
	
	public function getActionClass(){
		return array(
				'add',
				'view',
				'edit',
				'delete',
				'userAdd',
				'userView',
				'userEdit',
				'userDelete'
		);
	}
	
	public function getForm($model){
		$config = array(
				'elements' => array(
						'property_name' => array(
								'type' => 'text',
								'label' => '物管名称',
								'class' => 'form-input-text'
						)
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
	
	public function getUserForm($model){
		$properties = Property::model()->findAll();
		$pData = array();
		foreach ( $properties as $property ){
			$pData[$property->primaryKey] = $property->property_name;
		}
		$config = array(
				'elements' => array(
						'property_id' => array(
								'type' => 'dropdownlist',
								'label' => '所属物管',
								'items' => $pData,
								'class' => 'form-input-dropdownlist',
						),
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
						'realname' => array(
								'type' => 'text',
								'label' => '真实姓名',
								'class' => 'form-input-text'
						),
						'phone' => array(
								'type' => 'text',
								'label' => '手机号',
								'class' => 'form-input-text',
						),
						'email' => array(
								'type' => 'text',
								'label' => '邮箱',
								'class' => 'form-input-text'
						)
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