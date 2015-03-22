<?php
/* @var $this AreainteresController */
/* @var $model Areainteres */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'areainteres-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador',array('size'=>60,'maxlength'=>1500)); ?>
		<?php echo $form->error($model,'identificador'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'secuenciainteres'); ?>
		<?php echo $form->textField($model,'secuenciainteres',array('size'=>60,'maxlength'=>1500)); ?>
		<?php echo $form->error($model,'secuenciainteres'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->