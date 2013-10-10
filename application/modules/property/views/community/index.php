

<div class="table-list">
  <div class="form-title">小区管理</div>
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
					<td><?php echo $value->community_name;?></td>
					<td><?php echo $value->area->area_name;?></td>
					<td>
          <a href="<?php echo $this->createUrl('community/update',array('id'=>$value['id']));?>">修改信息</a>|
					<a href="<?php echo $this->createUrl('community/delete',array('id'=>$value['id']));?>">删除</a>|
          <a href="<?php echo $this->createUrl('community/view',array('id'=>$value['id']));?>">家庭查看</a>
          </td>
				</tr>
				<?php }?>

			</tbody>	
  		</table>
  		</br>
  		</br>
  		</br>
  			<div id="pager">
			<?php
              $this->widget('CLinkPager',array(
                  'header'=>'',
                  'firstPageLabel'=>'首页',
                  'lastPageLabel'=>'末页',
                  'prevPageLabel'=>'上一页',
                  'nextPageLabel'=>'下一页',
                  'pages'=>$pages,
                  'maxButtonCount'=>13
                )
              )
          ?>
      	</div>
  	</div>
 
</div>
