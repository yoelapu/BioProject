<?php
/* @var $this GenController */
/* @var $model Gen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

        <div class="row">
		<?php echo $form->label($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador',array('size'=>60,'maxlength'=>500)); ?>
	</div>
        
	<div class="row">
		<?php echo $form->label($model,'codigoaccesion'); ?>
		<?php echo $form->textField($model,'codigoaccesion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'organismoorigen'); ?>
		<?php echo $form->textField($model,'organismoorigen',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secuenciacompleta'); ?>
		<?php echo $form->textField($model,'secuenciacompleta',array('size'=>60,'maxlength'=>5000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cds'); ?>
		<?php echo $form->textField($model,'cds',array('size'=>60,'maxlength'=>1500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->