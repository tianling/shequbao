<?php
/**
 * @name RestApiRules.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-1
 * Encoding UTF-8
 */
return array(
		array(
				'pattern' => 'user/<resourceId:\d+>:Chat',
				'friends/service/chat',
				'verb'=>'POST'
		),
		array(//create a resource
				'pattern'=>'<_m:(user)>',
				'<_m>/service/create',
				'verb'=>'POST'
		),
		array(//update a resource
				'pattern'=>'<_m:(user)>/<id:\d+>',
				'<_m>/service/update',
				'verb'=>'PUT'
		),
		array(//user login logout
				'pattern'=>'user/<_a:(login|logout)>',
				'user/service/<_a>',
				'verb'=>'POST,PUT'
		),
 		array(//create resource which belongs to another resource
				'pattern'=>'<_m:(user|friends)>/<resourceId:\d+>:<_a:(Address|Hello|Friend|Trend|Reply|Support)>',
 				'<_m>/service/create<_a>',
 				'verb'=>'POST'
		),
		array(//update resource which belongs to another resource
				'pattern'=>'<_m:(user|ad)>/<resourceId:\d+>:<_a:(Address|Balance)>/<id:\d+>',
				'<_m>/service/update<_a>',
				'verb'=>'PUT'
		),
		array(
				'pattern'=>'<_m:(user|friends)>/<resourceId:\d+>:<_a:(Address|Bind|SayHelloToMe|RandomFriends|Trends|MyTrends|FriendsTrends|OfflineMessage)>',
				'<_m>/service/get<_a>',
				'verb'=>'GET'
		),
		array(
				'pattern'=>'<_m:(friends)>/<resourceId:\d+>:<_a:(removeFriend|removeTrend)>',
				'<_m>/service/<_a>',
				'verb'=>'POST'
		),
		array(
				'pattern'=>'<_m:(ad)>/<_a:(Ad)>',
				'<_m>/service/get<_a>',
				'verb'=>'GET'
		),
		array(
				'pattern'=>'<_m:(ad)>/<id:\d+>:<_a:(View)>/<uid:\d+>',
				'<_m>/service/update<_a>',
				'verb'=>'PUT'
		),
);