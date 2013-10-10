<?php
class CommunityController extends SqbController
{
	public $actionClassPathAlias = 'property.controllers';
	
	public function getActionClass(){
		return array(
				'view',
				'add',
				'edit',
				'delete',
				'viewUser',
				'pushMessage',
				'pushMessageToUser'
		);
	}
	
	public function getCommunityForm($model){
		$area = Area::model()->findAll('fid =:id',array(':id'=>2449));
		$areaData = array();
		foreach ( $area as $a ){
			$areaData[$a->primaryKey] = $a->area_name;
		}
		
		$config = array(
				'elements' => array(
						'location' => array(
								'type' => 'dropdownlist',
								'items' => $areaData,
								'label' => '所在地区',
								'class' => 'form-input-dropdownlist',
						),
						'community_name' => array(
								'type' => 'text',
								'label' => '小区名称',
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
