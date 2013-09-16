

<h1>Advertises</h1>

<?php
	foreach($advertiseData as $value){
		echo $value->title;
		echo '<br/>';}?>
		<a href="<?php echo Yii::app()->createUrl('ad/advertise/update',array('id'=>$value['id']));?>">修改信息</a>
	

		


