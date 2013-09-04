<?php
/**
 * @name RestApiRules.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-1
 * Encoding UTF-8
 */
return array(
		array('pattern'=>'<_m:(user)>','<_m>/service/create','verb'=>'POST'),//create a resource
		array('pattern'=>'<_m:(user)>/<id:\d+>','<_m>/service/update','verb'=>'PUT'),//update a resource
		array('pattern'=>'user/<_a:(login|logout)>','user/service/<_a>','verb'=>'POST,PUT'),//user login logout
);