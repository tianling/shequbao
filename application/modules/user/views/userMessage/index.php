<div class="table-list">
			<table width="100%" cellspacing="0" id="tree">
				<thead>
					<tr>
						<th width="10%">用户昵称</th>
						<th width="50%">内容</th>
						<th width="15%">提交时间</th>
						<th width="20%">管理操作</th>
					</tr>
				</thead>

				<tbody align="center">
				<?php foreach ( $messages as $messageData ):?>
				<tr>
					<td><?php echo $messageData['nickname'];?></td>
					<td><?php echo $messageData['content']?></td>
					<td><?php echo date('Y:m:d H:i:s',$messageData['add_time']);?></td>
					<td>
						<a href="<?php echo $this->createUrl('userMessage/reply',array('id'=>$messageData['id']))?>">回复</a> | 
						<a href="<?php echo $this->createUrl('userMessage/delete',array('id'=>$messageData['id']));?>">删除</a>
					</td>
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>
<?php 
$this->renderPartial('//common/pager',array('pager'=>$pager));
?>
</div>