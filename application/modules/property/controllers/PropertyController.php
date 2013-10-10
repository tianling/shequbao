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
}