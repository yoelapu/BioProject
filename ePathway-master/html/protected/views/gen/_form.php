<?php
/* @var $this GenController */
/* @var $model Gen */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gen-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador',array('size'=>50,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'identificador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigoaccesion'); ?>
		<?php echo $form->textField($model,'codigoaccesion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'codigoaccesion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organismoorigen'); ?>
		<?php echo $form->textField($model,'organismoorigen',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'organismoorigen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'secuenciacompleta'); ?>
		<?php echo $form->textArea($model,'secuenciacompleta',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'secuenciacompleta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cds'); ?>
		<?php echo $form->textArea($model,'cds',array('size'=>60,'maxlength'=>1500)); ?>
		<?php echo $form->error($model,'cds'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->