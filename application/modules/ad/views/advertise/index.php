

<div class="table-list">
  	<div class="table-list">
  		<table width="100%" cellspacing="0" id="tree">
  			<thead>
				<tr>
					<th width="15%">广告标题</th>
					<th width="30%">每次点击扣费额度</th>
					<th width="10%">优先级</th>
					<th width="35%">投放小区</th>
					<th width="35%">管理操作</th>
				</tr>
			</thead>

			<tbody align="center">
				<?php
					foreach($advertiseData as $key => $value){
				?>
				<tr>
					<td><?php echo $value->title;?></td>
					<td><?php echo $value->cpc."元";?></td>
					<td><?php echo Advertise::getAdvertisePriority($value->priority);?></td>
					<td><?php echo Advertise::getCommunityName($value->community);?></td>
					<td><a href="<?php echo Yii::app()->createUrl('ad/advertise/update',array('id'=>$value['id']));?>">修改信息</a>|
					<a href="<?php echo Yii::app()->createUrl('ad/advertise/delete',array('id'=>$value['id']));?>">删除</a></td>
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

		
		
	

		


