<?php
/* @var $this UserChargeController */
/* @var $model UserChargeInfo */

$this->breadcrumbs=array(
	'User Charge Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserChargeInfo', 'url'=>array('index')),
	array('label'=>'Create UserChargeInfo', 'url'=>array('create')),
	array('label'=>'View UserChargeInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserChargeInfo', 'url'=>array('admin')),
);
?>

<h1>Update UserChargeInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>