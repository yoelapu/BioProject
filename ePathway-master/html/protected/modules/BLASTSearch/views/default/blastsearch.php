<?php
/* @var $this DefaultController */
$this->menu=array(
        array('label'=>'BLAST index', 'url'=>array('index')),
        //array('label'=>'Check Jobs', 'url'=>array('index'))
        array('label'=>'Modify configuration', 'url'=>array('BLASTGene/configuration')),
        array('label'=>'View stored configuration', 'url'=>array('BLASTGene/viewConfiguration')),
    );

$this->breadcrumbs=array(
        $this->module->id => array('index'),
	'Search'
);
?>
<h1>BLASTSearch</h1>
<div class="form">
<?php
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'blast-search-form',
                'enableClientValidation' => true,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )
        );
    ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
        
	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>50,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'JobTitle'); ?>
		<?php echo $form->textField($model,'JobTitle',array('size'=>50,'maxlength'=>500,'value'=>'Job 1')); ?>
		<?php echo $form->error($model,'JobTitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SequenceType'); ?>
                <?php echo $form->ListBox($model,'SequenceType', 
                    array('dna' => 'dna','protein' => 'protein')); ?>
		<?php /*echo $form->textField($model,'SequenceType',array('size'=>50,'maxlength'=>500));*/ ?>
		<?php echo $form->error($model,'SequenceType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Sequence'); ?>
		<?php echo $form->textArea($model,'Sequence',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'Sequence'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Program'); ?>
                <?php echo $form->ListBox($model,'Program', 
                     array('blastn' => 'blastn', 'tblastn' => 'tblastn')); ?>
		<?php /*echo $form->textField($model,'Program',array('size'=>60,'maxlength'=>5000));*/ ?>
		<?php echo $form->error($model,'Program'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'Database'); ?>
                <?php echo $form->ListBox($model,'Database', 
                    array('em_rel_pln' => 'em_rel_pln')); ?>
		<?php /*echo $form->textField($model,'Database',array('size'=>60,'maxlength'=>5000)); */?>
		<?php echo $form->error($model,'Database'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Matriz'); ?>
                <?php echo $form->ListBox($model,'Matriz', 
                    array('BLOSUM62' => 'BLOSUM62','BLOSUM45'=>'BLOSUM45','BLOSUM50'=>'BLOSUM50',
                          'BLOSUM80' => 'BLOSUM80','BLOSUM90'=>'BLOSUM90',
                          'PAM30' => 'PAM30','PAM70'=>'PAM70',
                          'PAM250' => 'PAM250'), array('selected'=>'BLOSUM62')); ?>
		<?php /*echo $form->textField($model,'Database',array('size'=>60,'maxlength'=>5000)); */?>
		<?php echo $form->error($model,'Matriz'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'Scores'); ?>
		<?php echo $form->textField($model,'Scores',array('size'=>60,'maxlength'=>5000, 'value'=>'50')); ?>
		<?php echo $form->error($model,'Scores'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'Alignments'); ?>
		<?php echo $form->textField($model,'Alignments',array('size'=>60,'maxlength'=>5000, 'value'=>'50')); ?>
		<?php echo $form->error($model,'Alignments'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'ExpectValThreshold'); ?>
		<?php echo $form->textField($model,'ExpectValThreshold',array('size'=>60,'maxlength'=>5000, 'value' => '10')); ?>
		<?php echo $form->error($model,'ExpectValThreshold'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'Organism'); ?>
		<?php echo $form->textField($model,'Organism',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'Organism'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton('BLAST'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>