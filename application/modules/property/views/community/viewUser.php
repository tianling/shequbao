<?php
/**
 * @name viewUser.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-11
 * Encoding UTF-8
 */
?>

<div class="table-list">
<?php echo $form?>
		<table width="100%" cellspacing="0" id="tree">
  			<thead>
				<tr>
					<th width="10%">用户手机号</th>
					<th width="30%">用户昵称</th>
					<th width="30%">上次登录时间</th>
					<th width="30%">管理操作</th>
				</tr>
			</thead>

			<tbody align="center">
			<?php foreach ( $list as $data ):?>
				<tr>
					<td><?php echo $data->user->mobile?>
					<td><?php echo $data->user->baseUser->nickname?></td>
					<td><?php echo date('Y年m月d日',$data->user->baseUser->last_login_time)?></td>
					<td>
						<a href="<?php echo $this->createUrl('community/pushMessageToUser',array('user'=>$data->user->id,'community'=>$data->community_id))?>">推送消息</a> | 
						<a href="<?php echo $this->createUrl('/user/userCharge/create',array('id'=>$data->user->id))?>">欠费添加</a> | 
						<a href="<?php echo $this->createUrl('/user/userCharge/index',array('id'=>$data->user->id))?>">缴费查询</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
</div>