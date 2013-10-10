<?php
/**
 * @name viewAdByAdver.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-9
 * Encoding UTF-8
 */
?>
<div class="table-list">
  	<div class="table-list">
  		<table width="100%" cellspacing="0" id="tree">
  			<thead>
				<tr>
					<th width="15%">广告标题</th>
					<th width="30%">每次点击扣费额度</th>
					<th width="10%">优先级</th>
				</tr>
			</thead>

			<tbody align="center">
				<?php
					foreach($list as $key => $value){
				?>
				<tr>
					<td><?php echo $value->title;?></td>
					<td><?php echo $value->cpc."元";?></td>
					<td><?php echo Advertise::getAdvertisePriority($value->priority);?></td>
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
                  'pages'=>$pager,
                  'maxButtonCount'=>13
                )
              )
          ?>
      	</div>
  	</div>
 
</div>