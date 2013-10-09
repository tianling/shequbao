<?php
/**
 * @name ViewChatForm.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-8
 * Encoding UTF-8
 */
class ViewChatForm extends CFormModel{
	public $searchType;
	public $keyword;
	
	public function rules(){
		return array(
				array('searchType,keyword','required','message'=>'{attribute}不能为空'),
		);
	}
	
	public function attributeLabels(){
		return array(
				'searchType' => '搜索对象',
				'keyword' => '对象名称'
		);
	}
}