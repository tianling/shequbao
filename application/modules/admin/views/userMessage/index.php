<div class="form-list">
	<div class="form-title">用户反馈管理</div>
		<div class="table-list">
			<table width="100%" cellspacing="0" id="tree">
				<thead>
					<tr>
						<th width="30%">用户昵称</th>
						<th width="30%">提交时间</th>
						<th width="40%">管理操作</th>
					</tr>
				</thead>

				<tbody align="center">
					<?php
					foreach($messageData as $key =>$value){
					?>
				<tr>
					<td><?php echo $value->UserMessage->nickname;?></td>
					<td><?php echo date('Y:m:d H:i:s',$value->add_time);?></td>
					<td><a href="<?php echo Yii::app()->createUrl('sqbadmin/usermessage/view',array('id'=>$value->id));?>">查看</a>|
					<a href="<?php echo Yii::app()->createUrl('sqbadmin/usermessage/delete',array('id'=>$value->id));?>">删除</a></td>
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
</div>