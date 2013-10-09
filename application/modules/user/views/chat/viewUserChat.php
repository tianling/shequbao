<?php
/**
 * @name viewUserChat.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-8
 * Encoding UTF-8
 */
?>
<div class="table-list">
		<table width="100%" cellspacing="0" id="tree">
			<thead>
				<tr>
					<th width="20%"></th>
					<th width="12%"></th>
					<th width="20%"></th>
					<th width="60%"></th>
				</tr>
			</thead>
			<tbody>
			<?php
			if ( $data !== array() ):
				foreach ( $data as $d ):
			?>
				<tr>
					<td><?php echo $d->sender == $mUid ? $userName : $sUserName?></td>
					<td style="text-align: left">在<?php echo date('Y年m月d日H:s',$d->send_time)?>对</td>
					<td><?php echo $d->receiver == $mUid ? $userName : $sUserName;?></td>
					<td style="text-align: left">说：<?php echo $d->content?></td>
				</tr>
			<?php
				endforeach;
			else:
			?>
				<tr>
					<td colspan="4">暂无记录</td>
				</tr>
			<?php endif;?>
			</tbody>
		</table>
<?php 
	$this->renderPartial('//common/pager',array('pager'=>$pager));
?>
</div>