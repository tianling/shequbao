<?php
/* @var $this AdvertiserController */
/* @var $model Advertiser */
/* @var $form CActiveForm */
?>

<div class="form-list">
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
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="errorMessage">
		<?php echo $form->errorSummary($model); ?>
	</div>
	<br />
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('class'=>'form-input-text')); ?>
	<br />
	<br />
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('class'=>'form-input-textarea')); ?>
	<br />
		<?php echo $form->labelEx($model,'direct_to'); ?>
		<?php echo $form->textField($model,'direct_to',array('class'=>'form-input-text'));?>
	<br />
		<?php echo $form->labelEx($model,'cpc'); ?>
		<?php echo $form->textField($model,'cpc',array('class'=>'form-input-text'));?>
	<br />
		<?php echo $form->labelEx($model,'priority'); ?>
	
		<?php echo $form->dropDownList($model,'priority',array(
			'0'=>'低',
			'1'=>'中',
			'2'=>'高',
			'3'=>'非常高',
			
		),array('class'=>'form-input-text'));?>
	<br />
	<br />
	<?php if(isset($adPic) && !empty($adPic)){?>
		<img src = "<?php echo  Yii::app()->request->baseUrl.$adPic;?>"/>
	<?php }?>		
	<br/>

	<?php  if(isset($adPic) && !empty($adPic)){
				echo "修改图片"; 
			}else
				echo "图片上传";
		?>

	 <div class="swfupload"><span id="swfupload">上传</span>(只可以上传1张,支持格式:png,jpg,gif.)</div>

	 <?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存修改',array('id'=>'reply','name'=>'submit','class'=>'form-button form-button-submit')); ?>

<?php $this->endWidget(); ?>

</div>