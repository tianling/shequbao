<div class="form-list">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertise-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>
	<?php echo $form->labelEx($model,'小区名称'); ?>
	<?php echo $form->textField($model,'community_name',array('class'=>'form-input-text')); ?>
	<?php echo $form->error($model,'community_name'); ?>

	</br>
	</br>
	<?php echo $form->labelEx($model,'小区区域'); ?>
	<?php echo $form->dropDownList($model,'location',$areaData,array('class'=>'form-input-text'));?>
	<?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存修改',array('id'=>'reply','name'=>'submit','class'=>'form-button form-button-submit')); ?>
	<?php $this->endWidget(); ?>

</div>