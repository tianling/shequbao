<?php
/**
 * @name view.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
?>
<div class="table-list">
		<table width="100%" cellspacing="0" id="tree">
			<thead>
				<tr>
					<th width="8%">id</th>
					<th width="5%">姓氏</th>
					<th width="5%">名字</th>
					<th width="10%">昵称</th>
					<th width="10%">手机号</th>
					<th width="15%">邮箱</th>
					<th width="10%">上次登录时间</th>
					<th width="10%">上次登录IP</th>
					<th width="25%">管理操作</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ( $users as $user ):?>
				<tr>
					<td><?php echo $user->primaryKey;?></td>
					<td><?php echo $user->surname;?></td>
					<td><?php echo $user->name;?></td>
					<td><?php echo $user->nickname;?></td>
					<td><?php echo $user->phone;?></td>
					<td><?php echo $user->email;?></td>
					<td><?php echo date('Y年m月d日',$user->last_login_time);?></td>
					<td><?php echo $user->last_login_ip;?></td>
					<td>
						<a href="<?php echo $this->createUrl('/accessManage/assignment/groupUser',array('user'=>$user->primaryKey))?>">用户组授权</a> | 
						<a href="<?php echo $this->createUrl('/accessManage/assignment/role',array('user'=>$user->primaryKey))?>">角色授权</a> | 
						<a href="<?php echo $this->createUrl('user/edit',array('id'=>$user->primaryKey))?>">编辑</a> | 
						<a href="<?php echo $this->createUrl('user/delete',array('id'=>$user->primaryKey))?>">删除</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
			
		</table>
<?php 
	$this->renderPartial('//common/pager',array('pager'=>$pager));
?>
</div>