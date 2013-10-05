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
					<th width="10%">昵称</th>
					<th width="10%">手机号码</th>
					<th width="15%">邮箱</th>
					<th width="2%">创建群数</th>
					<th width="8%">身份证</th>
					<th width="8%">上次登录时间</th>
					<th width="20%">管理操作</th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach ( $list as $data ):?>
				<tr>
					<td><?php echo $data->nickname;?></td>
					<td><?php echo $data->mobile;?></td>
					<td><?php echo $data->email;?></td>
					<td><?php echo $data->groups;?></td>
					<td><?php echo $data->identity_id;?></td>
					<td><?php echo date('Y年m月d日',$data->last_login_time);?></td>
					<td></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
<?php 
	$this->renderPartial('//common/pager',array('pager'=>$pager));
?>
</div>