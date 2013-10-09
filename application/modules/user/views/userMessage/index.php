<div class="table-list">
			<table width="100%" cellspacing="0" id="tree">
				<thead>
					<tr>
						<th width="30%">用户昵称</th>
						<th width="30%">提交时间</th>
						<th width="40%">管理操作</th>
					</tr>
				</thead>

				<tbody align="center">
					<?php
					for($i =0 ; $i< $count ;$i++ ){
					?>
				<tr>
					<td><?php echo $messageData[$i]['nickname'];?></td>
					<td><?php echo date('Y:m:d H:i:s',$messageData[$i]['add_time']);?></td>
					<td><a href="<?php echo $this->createUrl('usermessage/view',array('id'=>$messageData[$i]['id']));?>">查看</a>|
					<a href="<?php echo $this->createUrl('usermessage/delete',array($messageData[$i]['id']));?>">删除</a></td>
				</tr>
				<?php }?>

				</tbody>
			</table>
		</div>
</div>