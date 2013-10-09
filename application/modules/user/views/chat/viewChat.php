<?php
/**
 * @name viewChat.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-8
 * Encoding UTF-8
 */
?>
<div>
	<?php echo $form?>
</div>
<?php if ( $data !== array() ):?>
<div class="table-list">
		<table width="100%" cellspacing="0" id="tree">
			<thead>
				<tr>
					<th width="15%">搜索结果</th>
					<th width="8%">操作</th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach ( $data as $d ):?>
				<tr>
					<td><?php echo $d['name']?></td>
					<td><a href="<?php echo $this->createUrl($route,array('id'=>$d['id']))?>">查看聊天记录</a></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
<?php 
	$this->renderPartial('//common/pager',array('pager'=>$pager));
?>
</div>
<?php endif;?>