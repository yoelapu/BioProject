<?php
/* @var $this AreainteresController */
/* @var $model Areainteres */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secuenciainteres'); ?>
		<?php echo $form->textField($model,'secuenciainteres',array('size'=>60,'maxlength'=>1500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtbl_gen'); ?>
		<?php echo $form->textField($model,'idtbl_gen'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->