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
				'pattern'=>'<_m:(user|friends)>/<resourceId:\d+>:<_a:(Address|MyContacts|FamilyMember|FamilyConfirm|Hello|Friend|Trend|Reply|Support)>',
 				'<_m>/service/create<_a>',
 				'verb'=>'POST'
		),
		array(
				'pattern'=>'user/<resourceId:\d+>:<_a:(Group|GroupMember|ConfirmGroup)>',
				'friends/service/create<_a>',
				'verb'=>'POST'
		),
		array(//update resource which belongs to another resource
				'pattern'=>'<_m:(user|friends)>/<resourceId:\d+>:<_a:(Address|Remark)>/<id:\d+>',
				'<_m>/service/update<_a>',
				'verb'=>'PUT'
		),
		array(
				'pattern'=>'<_m:(user|friends|area|access)>/<resourceId:\d+>:<_a:(Address|FamilyInvitation|Community|Bind|MyContacts'
						.'|SayHelloToMe|SearchFriends|GroupApplication|RandomFriends|RandomGroups'
						.'|SearchGroups|Groups|JoinedGroups|GroupMember'
						.'|Trends|FriendsTrends|OfflineMessage'
						.'|OperationChildren)>',
				'<_m>/service/get<_a>',
				'verb'=>'GET'
		),
		array(
				'pattern' => '<_m(area)>/<_a:(Level)>/<resourceId:\d+>',
				'<_m>/service/get<_a>',
				'verb'=>'GET'
		),
		array(
				'pattern'=>'area/<resourceId:\d+>:<_a:(DirectChildren|AllChildren)>',
				'area/service/get<_a>',
				'verb'=>'GET'
		),
		array(//delete
				'pattern'=>'<_m:(friends|user)>/<resourceId:\d+>:<_a:(removeFriend|removeTrend|removeGroupMember)>',
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
		array(
				'pattern'=>'<_m:(ad)>/<resourceId:\d+>:<_a:(BalanceClick)>/<id:\d+>/<uid:\d+>',
				'<_m>/service/update<_a>',
				'verb'=>'PUT'
		),
		array(
				'pattern'=>'<_m:(user)>/<uid:\d+>:<_a:(CloseUser)>/<lag:\S+>/<lng:\S+>',
				'<_m>/service/get<_a>',
				'verb'=>'GET'
		),
		array(
				'pattern'=>'<_m:(user)>/<_a:(Message)>/<uid:\d+>/<content:\S+>',
				'<_m>/service/create<_a>',
				'verb'=>'POST'

		),
		array(
				'pattern'=>'<_m:(user)>/<_a:(CleanMyplace)>/<uid:\d+>',
				'<_m>/service/<_a>',
				'verb'=>'POST'

		),

);