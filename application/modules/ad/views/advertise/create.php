<?php
/* @var $this AdvertiserController */
/* @var $model Advertiser */

$this->breadcrumbs=array(
	'Advertisers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Advertiser', 'url'=>array('index')),
	array('label'=>'Manage Advertiser', 'url'=>array('admin')),
);
?>
<?php
 Yii::app()->clientScript->registerScript('deleteThumb',"
    $('a#dele').live('click',function(){
      $(this).parent().remove();
      var stats = swfu.getStats();
      stats.successful_uploads--;
      swfu.setStats(stats);
      return false;
    })");
?>
<h1>Create Advertise</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>