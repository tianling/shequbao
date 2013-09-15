<?php
/* @var $this AdvertiserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Advertisers',
);

$this->menu=array(
	array('label'=>'Create Advertiser', 'url'=>array('create')),
	array('label'=>'Manage Advertiser', 'url'=>array('admin')),
);
?>

<h1>Advertisers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
