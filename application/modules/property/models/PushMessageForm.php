<?php
/**
 * @name PushMessageForm.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
class PushMessageForm extends CFormModel{
	public $title;
	public $content;
	
	public function rules(){
		return array(
				array('content,title','required','message'=>'{attribute}不能为空'),
				array('content','length','max'=>80,'tooLong'=>'推送内容太长，最多80字')
		);
	}
	
	public function attributeLabels(){
		return array(
				'content' => '推送内容',
				'title' => '标题'
		);
	}
}