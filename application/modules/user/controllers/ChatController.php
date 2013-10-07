<?php
/**
 * @name ChatController.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-7
 * Encoding UTF-8
 */
class ChatController extends SqbController{
	public $actionClassPathAlias = 'application.modules.user.controllers';
	
	public function getActionClass(){
		return array(
				'userChat',
				'groupChat',
				'roomChat'
		);
	}
}