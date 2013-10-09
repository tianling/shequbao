<?php
/**
 * @name viewFriendsList.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-8
 * Encoding UTF-8
 */
?>
<div>
	<form action="<?php echo $this->createUrl('',array('id'=>$mUid))?>" method="get">
		<div>
			搜索与该用户聊天的用户&nbsp;&nbsp;<input class="form-input-text" type="text" name="keyword" value="<?php echo $keyword?>" />
		</div>
		<div>
			<input class="form-button" type="submit" value="搜索" />
		</div>
	</form>
</div>

<div class="table-list">
	<table width="100%" cellspacing="0" id="tree">
			<tbody>
			<?php foreach ( $data as $d ):
				$followed = $d->getRelated('followed');
			?>
				<tr style="text-align: left">
					<td>
						<a href="<?php echo $this->createUrl('',array('id'=>$mUid,'sUid'=>$followed->primaryKey))?>">
						查看与<pre style="display:inline-block">   <?php echo $followed->nickname?>    的聊天记录</pre>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
	</table>
<?php 
	$this->renderPartial('//common/pager',array('pager'=>$pager));
?>
</div>