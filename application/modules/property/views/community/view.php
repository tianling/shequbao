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
  		<table width="100%" cellspacing="0" id="tree">
  			<thead>
				<tr>
					<th width="30%">小区名称</th>
					<th width="30%">所在区域</th>
					<th width="30%">管理操作</th>
					
				</tr>
			</thead>

			<tbody align="center">
				<?php
					foreach($communityData as $key => $value){
				?>
				<tr>
					<td><?php echo $value->community->community_name;?></td>
					<td><?php echo $value->community->area->area_name;?></td>
					<td>
						<a href="<?php echo $this->createUrl('community/pushMessage',array('community'=>$value->community_id))?>">推送通知</a> | 
						<a href="<?php echo $this->createUrl('community/viewUser',array('community'=>$value->community_id));?>">查看小区用户</a> | 
          				<a href="<?php echo $this->createUrl('community/edit',array('id'=>$value->community_id));?>">修改信息</a>|
						<a href="<?php echo $this->createUrl('community/delete',array('id'=>$value->community_id));?>">删除</a>
          			</td>
				</tr>
				<?php }?>

			</tbody>	
  		</table>
<?php 
$this->renderPartial('//common/pager',array('pager'=>$pages));
?>
</div>