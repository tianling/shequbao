<?php
/* @var $this CommunityController */
/* @var $model Community */

$this->breadcrumbs=array(
	'Communities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Community', 'url'=>array('index')),
	array('label'=>'Create Community', 'url'=>array('create')),
	array('label'=>'Update Community', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Community', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Community', 'url'=>array('admin')),
);
?>

<h1>View Community #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'location',
		'community_name',
	),
)); ?>
