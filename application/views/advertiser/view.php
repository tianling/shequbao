<?php
/* @var $this AdvertiserController */
/* @var $model Advertiser */

$this->breadcrumbs=array(
	'Advertisers'=>array('index'),
	$model->advertiser_id,
);

$this->menu=array(
	array('label'=>'List Advertiser', 'url'=>array('index')),
	array('label'=>'Create Advertiser', 'url'=>array('create')),
	array('label'=>'Update Advertiser', 'url'=>array('update', 'id'=>$model->advertiser_id)),
	array('label'=>'Delete Advertiser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->advertiser_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Advertiser', 'url'=>array('admin')),
);
?>

<h1>View Advertiser #<?php echo $model->advertiser_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'advertiser_id',
		'balance',
		'phone',
	),
)); ?>
