<?php
/* @var $this AdvertiserController */
/* @var $model Advertiser */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
	
	$this->widget('application.extensions.swfupload.CSwfUpload', array(
    'jsHandlerUrl'=>Yii::app()->request->baseUrl."/js/handlers.js", //配置swfupload事件的js文件
    'postParams'=>array('PHPSESSID'=>Yii::app()->session->sessionID),//由于flash上传不可以传递cookie只能将session_id用POST方式传递
    'config'=>array(
    	//'debug'=>true,//是否开启调试模式
        'use_query_string'=>true,
        'upload_url'=>$this->createUrl('advertise/upload'), //对应处理图片上传的controller/action
        'file_size_limit'=>'2 MB',//文件大小限制
        'file_types'=>'*.jpg;*.png;*.gif',//文件格式限制
        'file_types_description'=>'Image Files',
        'file_upload_limit'=>100,
        'file_queue_limit'=>0,//一次上传文件个数
        'file_queue_error_handler'=>'js:fileQueueError',
        'file_dialog_complete_handler'=>'js:fileDialogComplete',
        'upload_progress_handler'=>'js:uploadProgress',
        'upload_error_handler'=>'js:uploadError',
        'upload_success_handler'=>'js:uploadSuccess',
        'upload_complete_handler'=>'js:uploadComplete',
        'custom_settings'=>array('upload_target'=>'divFileProgressContainer'),
        'button_placeholder_id'=>'swfupload',
        'button_width'=>140,
        'button_height'=>28,
        'button_image_url'=>Yii::app()->request->baseUrl."/images/uploadButton.jpg",
        'button_text'=>'<span class="button">上传(Max 2 MB)</span>',
        'button_text_style'=>'.button { font-family:"微软雅黑", sans-serif; font-size: 15px; text-align: center;color: #666666; }',
        'button_text_top_padding'=>0,
        'button_text_left_padding'=>0,
        'button_window_mode'=>'js:SWFUpload.WINDOW_MODE.TRANSPARENT',
        'button_cursor'=>'js:SWFUpload.CURSOR.HAND',
        ),
    )
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertise-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'advertiser_id'); ?>
		<?php echo $form->textField($model,'advertiser_id'); ?>
		<?php echo $form->error($model,'advertiser_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content'); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direct_to'); ?>
		<?php echo $form->textField($model,'direct_to'); ?>
		<?php echo $form->error($model,'direct_to'); ?>
	</div>

	<div calss="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->dropDownList($model,'priority',array(
			'0'=>'低',
			'1'=>'中',
			'2'=>'高',
			'3'=>'非常高'
		));?>
	</div>
	
	 <div class="swfupload"><span id="swfupload">上传</span>(只可以上传1张,支持格式:png,jpg,gif.)</div>

	<div class="row buttons">
		 <?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存修改',array('id'=>'reply','name'=>'submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->