<?php
/* @var $this BLASTGeneController */
/* @var $model BLASTGene */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blastgene-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'JobTitle'); ?>
		<?php echo $form->textField($model,'JobTitle',array('size'=>50,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'JobTitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SequenceType'); ?>
                <?php echo $form->ListBox($model,'SequenceType', 
                    array('dna' => 'dna')); ?>
		<?php echo $form->error($model,'SequenceType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Program'); ?>
                <?php echo $form->ListBox($model,'Program', 
                    array('blastn' => 'blastn')); ?>
		<?php echo $form->error($model,'Program'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Database'); ?>
                <?php echo $form->ListBox($model,'Database', 
                    array('em_rel_pln' => 'em_rel_pln')); ?>
		<?php echo $form->error($model,'Database'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Scores'); ?>
		<?php echo $form->textField($model,'Scores',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'Scores'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Alignments'); ?>
		<?php echo $form->textField($model,'Alignments',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'Alignments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ExpectValThreshold'); ?>
		<?php echo $form->textField($model,'ExpectValThreshold',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'ExpectValThreshold'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->