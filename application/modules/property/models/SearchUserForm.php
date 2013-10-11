<?php
/**
 * @name SearchUserForm.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-11
 * Encoding UTF-8
 */
class SearchUserForm extends CFormModel{
	public $keyword;
	
	public function rules(){
		return array(
				array('keyword','safe','message'=>'搜索手机号不能为空')
		);
	}
}