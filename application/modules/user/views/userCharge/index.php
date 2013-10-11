<?php if($type == 1){
		$payType = "物管抄表";
	?>
<div class="table-list">
		<div class="table-list">
			<table width="100%" cellspacing="0" id="tree">
				<thead>
					<tr>
						<th width="30%">费用种类</th>
						<th width="30%">缴费方式</th>
						<th width="15%">金额</th>
						<th width="40%">提交时间</th>
						<th width="40%">管理操作</th>
					</tr>
				</thead>

				<tbody align="center">
					<?php
					foreach($ChargeData as $key =>$value){
					?>
				<tr>
					<td><?php echo UserChargeInfo::getChargeName($value->type);?></td>
					<td><?php echo $payType;?></td>
					<td><?php echo $value->charge;?></td>
					<td><?php echo date('Y-m-d H:i:s',$value->add_time);?></td>
					<td><a href="<?php echo Yii::app()->createUrl('user/usercharge/delete',array('id'=>$value->id,'uid'=>$value->uid));?>">删除</a></td>
				</tr>
				<?php }?>

				</tbody>
			</table>

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

<?php }elseif($type == 2){
		$payType = "用户自缴";
	?>
	<div class="table-list">
		<div class="table-list">
			<table width="100%" cellspacing="0" id="tree">
				<thead>
					<tr>
						<th width="30%">费用种类</th>
						<th width="30">缴费方式</th>
						<th width="15%">金额</th>
					</tr>
				</thead>

				<tbody align="center">
				<tr>
					<td>自来水费</td>
					<td><?php echo $payType;?></td>
					<td><?php echo $waterFee;?></td>
				</tr>
				<tr>
					<td>天然气费</td>
					<td><?php echo $payType;?></td>
					<td><?php echo $gasFee;?></td>
				</tr>
					<td>电费</td>
					<td><?php echo $payType;?></td>
					<td><?php echo $electricityFee;?></td>
				</tr>
				<tr>
					<td>垃圾处理费</td>
					<td><?php echo $payType;?></td>
					<td><?php echo $garbageFee;?></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php }else{?>
	<div class="table-list">
		<div class="table-list">
			<table width="100%" cellspacing="0" id="tree">
				<thead>
					<tr>
						<th width="30%">提示信息</th>
					</tr>
				</thead>

				<tbody align="center">
					<tr>
						<td><?php echo $data;?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php }?>