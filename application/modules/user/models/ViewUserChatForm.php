<?php
/**
 * @name ViewUserChatForm.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-8
 * Encoding UTF-8
 */
class ViewUserChatForm extends CFormModel{
	public $keyword;
	public function rules(){
		return array(
				array('keyword','required','message'=>'搜索用户名不能为空')
		);
	}
}