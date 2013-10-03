<?php
/* @var $this UserChargeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Charge Infos',
);

$this->menu=array(
	array('label'=>'Create UserChargeInfo', 'url'=>array('create')),
	array('label'=>'Manage UserChargeInfo', 'url'=>array('admin')),
);
?>

<h1>User Charge Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
