<?php
/* @var $this UserMessageController */
/* @var $model MessageBoard */

$this->breadcrumbs=array(
	'Message Boards'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MessageBoard', 'url'=>array('index')),
	array('label'=>'Create MessageBoard', 'url'=>array('create')),
	array('label'=>'View MessageBoard', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MessageBoard', 'url'=>array('admin')),
);
?>

<h1>Update MessageBoard <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>