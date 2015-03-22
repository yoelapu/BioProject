<?php
/* @var $this PrimerController */
/* @var $model Primer */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idtbl_primer'); ?>
		<?php echo $form->textField($model,'idtbl_primer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primerrinicio'); ?>
		<?php echo $form->textField($model,'primerrinicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primerrlongitud'); ?>
		<?php echo $form->textField($model,'primerrlongitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primerfinicio'); ?>
		<?php echo $form->textField($model,'primerfinicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primerflongitud'); ?>
		<?php echo $form->textField($model,'primerflongitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observaciones'); ?>
		<?php echo $form->textField($model,'observaciones',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtbl_gen'); ?>
		<?php echo $form->textField($model,'idtbl_gen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtbl_estadoprimer'); ?>
		<?php echo $form->textField($model,'idtbl_estadoprimer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->