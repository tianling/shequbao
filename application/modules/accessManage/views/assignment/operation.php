<?php
/**
 * @name operation.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-5
 * Encoding UTF-8
 */
?>
<div class="table-list">
	<form action="<?php echo $this->createUrl('assignment/permission') ?>" name="permissions">
		<table id="tree" style="width: 100%" class="treetable">
		<?php foreach ( $list as $lOne ):?>
		<tr data-tt-id="<?php $lOneId = $lOne['parent']->primaryKey; echo $lOneId?>">
			<td>
			<input type="checkbox" <?php if ( in_array($lOneId,$rolePermissions) ) echo 'checked' ?>>
			<?php echo $lOne['parent']->permission_name?>
			</td>
		</tr>
			<?php foreach ( $lOne['children'] as $lTwo ):?>
		<tr data-tt-id="<?php $lTwoId = $lTwo['parent']->primaryKey; echo $lTwoId?>" data-tt-parent-id="<?php echo $lTwoId?>">
			<td>
			<input type="checkbox" <?php if ( in_array($lTwoId,$rolePermissions) ) echo 'checked' ?>>
			<?php echo $lTwo['parent']->permission_name?>
			</td>
		</tr>
			<?php endforeach;?>
				<?php foreach ( $lTwo['children'] as $lThree ): ?>
		<tr data-tt-id="<?php $lThreeId = $lThree->primaryKey; echo $lThreeId?>" data-tt-parent-id="<?php echo $lThreeId?>">
			<td>
			<input type="checkbox" <?php if ( in_array($lThreeId,$rolePermissions) ) echo 'checked' ?>>
			<?php echo $lThree->permission_name?>
			</td>
		</tr>
				<?php endforeach;?>
		<?php endforeach;?>
		</table>
	</form>
</div>