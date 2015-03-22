<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	'Search'
);
?>

<h1>Search Sequence Prosite</h1>

<div class="form">
<?php
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'prosite-search-form',
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
            <?php echo $form->labelEx($model,'Sequence'); ?>
            <?php echo $form->textArea($model,'Sequence',array('size'=>60,'maxlength'=>5000)); ?>
            <?php echo $form->error($model,'Sequence'); ?>
       </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>