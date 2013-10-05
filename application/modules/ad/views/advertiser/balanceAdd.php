<div class="form-list">
<p>该广告主当前的余额为：</p>
</br>
<p><?php echo $balance."元";?></p>
<br/>
<p>请输入充值金额：</p>

<form name = "balance" method = "post" action = "<?php echo Yii::app()->createUrl('ad/advertiser/balanceAdd',array('id'=>$id));?>">
	<input type = "text" name = "balance_add" ></input>
	<input type = "submit" name = "submit" value = "确定充值"></input>
</form>



</div>