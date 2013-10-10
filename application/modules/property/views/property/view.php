<?php
/**
 * @name view.php UTF-8
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
					<th width="30%">ID</th>
					<th width="30%">物管名称</th>
					<th width="30%">管理操作</th>
				</tr>
			</thead>

			<tbody align="center">
			<?php foreach ( $list as $data ):?>
				<tr>
					<td><?php echo $data->primaryKey;?></td>
					<td><?php echo $data->property_name;?></td>
					<td>
						<a href="<?php echo $this->createUrl('community/view')?>">管理小区</a> | 
						<a href="<?php echo $this->createUrl('property/edit',array('id'=>$data->primaryKey))?>">编辑</a> | 
						<a href="<?php echo $this->createUrl('property/delete',array('id'=>$data->primaryKey))?>">删除</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
	</table>
</div>