<div class="form-list">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'advertiser-form',

		'enableAjaxValidation'=>true,
	)); ?>

	<?php echo $form->errorSummary($model); ?>
		<?php echo $form->labelEx($model,'种类'); ?>
		<?php echo $form->dropDownList($model,'type',array(
			'6'=>'水费',
			'1'=>'电费',
			'2'=>'气费',
			'3'=>'垃圾处理费',
			'4'=>'物管费',
			'5'=>'其他费用'
			
		),array('class'=>'form-input-text'));?>
</br>
</br>
		<?php echo $form->labelEx($model,'金额'); ?>
		<?php echo $form->textField($model,'charge',array('class'=>'form-input-text')); ?>
		<?php echo $form->error($model,'charge'); ?>
</br>
</br>
		<?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存修改',array('id'=>'reply','name'=>'submit','class'=>'form-button form-button-submit')); ?>
	<?php $this->endWidget(); ?>
</div>

