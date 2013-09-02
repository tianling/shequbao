<?php
/**
 * @name RestApiRules.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-1
 * Encoding UTF-8
 */
return array(
		array('user/service/signUp','pattern'=>'user','verb'=>'POST'),
		array('user/service/login','pattern'=>'user/login','verb'=>'POST')
);