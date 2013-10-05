

<div class="table-list">
  	<div class="table-list">
  		<table width="100%" cellspacing="0" id="tree">
  			<thead>
				<tr>
					<th width="30%">广告主昵称</th>
					<th width="15%">联系电话</th>
					<th width="10%">余额</th>
					<th width="15%">广告数目</th>
					<th width="40%">管理操作</th>
				</tr>
			</thead>

			<tbody align="center">
				<?php
					foreach($advertiserData as $key => $value){
				?>
				<tr>
					<td><?php echo $value->nickname;?></td>
					<td><?php echo $value->phone;?></td>
					<td><?php echo $value->balance;?></td>
					<td><?php echo $value->ads;?></td>
					<td>
					<a href="<?php echo Yii::app()->createUrl('accessManage/assignment/groupUser/user',array('id'=>$value['advertiser_id']));?>">用户组授权</a>
					<a href="<?php echo Yii::app()->createUrl('accessManage/assignment/role/user',array('id'=>$value['advertiser_id']));?>">角色授权</a>
					<a href="<?php echo Yii::app()->createUrl('ad/advertiser/update',array('id'=>$value['advertiser_id']));?>">修改信息</a>|
					<a href="<?php echo Yii::app()->createUrl('ad/advertiser/delete',array('id'=>$value['advertiser_id']));?>">删除</a>
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
                  'lastPageLabel'=>'尾页',
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

		
		
	

		


