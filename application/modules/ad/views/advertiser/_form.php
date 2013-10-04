<?php
/* @var $this AdvertiserController */
/* @var $model Advertiser */
/* @var $form CActiveForm */
?>

<div class="form-list">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertiser-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	
	
		<?php echo $form->labelEx($model,'昵称'); ?>
		<?php echo $form->textField($model,'nickname',array('class'=>'form-input-text')); ?>
		<?php echo $form->error($model,'nickname'); ?>
	</br>
	</br>
		<?php echo $form->labelEx($model,'密码'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-input-text')); ?>
		<?php echo $form->error($model,'password'); ?>
	</br>
	</br>
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('class'=>'form-input-text'));?>
		<?php echo $form->error($model,'phone'); ?>
	</br>
	</br>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-input-text'));?>
		<?php echo $form->error($model,'email'); ?>
	</br>
	</br>
		<?php echo $form->labelEx($model,'余额'); ?>
		<?php echo $form->textField($model,'balance',array('class'=>'form-input-text'));?>
		<?php echo $form->error($model,'balance'); ?>
		
	

	 <?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存修改',array('id'=>'reply','name'=>'submit','class'=>'form-button form-button-submit')); ?>

<?php $this->endWidget(); ?>

</div>