<?php
/* @var $this UserChargeController */
/* @var $model UserChargeInfo */

$this->breadcrumbs=array(
	'User Charge Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserChargeInfo', 'url'=>array('index')),
	array('label'=>'Create UserChargeInfo', 'url'=>array('create')),
	array('label'=>'Update UserChargeInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserChargeInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserChargeInfo', 'url'=>array('admin')),
);
?>

<h1>View UserChargeInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'type',
		'charge',
		'add_time',
	),
)); ?>
