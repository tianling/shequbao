<?php
/* @var $this AdvertiserController */
/* @var $data Advertiser */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('advertiser_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->advertiser_id), array('view', 'id'=>$data->advertiser_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balance')); ?>:</b>
	<?php echo CHtml::encode($data->balance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />


</div>