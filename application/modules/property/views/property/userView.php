<?php
/**
 * @name userView.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-10
 * Encoding UTF-8
 */
?>
<div class="table-list">
	<table width="100%" cellspacing="0">
  			<thead>
				<tr>
					<th width="15%">昵称</th>
					<th width="15%">手机号</th>
					<th width="10%">邮箱</th>
					<th width="30%">物管名称</th>
					<th width="30%">管理操作</th>
				</tr>
			</thead>

			<tbody align="center">
			<?php foreach ( $list as $data ):?>
				<tr>
					<td><?php echo $data->nickname?></td>
					<td><?php echo $data->phone;?></td>
					<td><?php echo $data->email;?></td>
					<td><?php echo $data->property->property_name;?></td>
					<td>
						<a href="<?php echo $this->createUrl('/accessManage/assignment/groupUser',array('user'=>$data->primaryKey))?>">用户组授权</a> | 
						<a href="<?php echo $this->createUrl('/accessManage/assignment/role',array('user'=>$data->primaryKey))?>">角色授权</a> | 
						<a href="<?php echo $this->createUrl('property/userEdit',array('id'=>$data->primaryKey))?>">编辑</a> | 
						<a href="<?php echo $this->createUrl('property/userDelete',array('id'=>$data->primaryKey))?>">删除</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
	</table>
<?php 
$this->renderPartial('//common/pager',array('pager'=>$pager));
?>
</div>