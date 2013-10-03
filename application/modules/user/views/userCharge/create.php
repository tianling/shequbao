<?php
/* @var $this UserChargeController */
/* @var $model UserChargeInfo */

$this->breadcrumbs=array(
	'User Charge Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserChargeInfo', 'url'=>array('index')),
	array('label'=>'Manage UserChargeInfo', 'url'=>array('admin')),
);
?>

<h1>Create UserChargeInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>