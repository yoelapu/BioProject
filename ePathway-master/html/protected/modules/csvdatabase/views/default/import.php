<?php
/* @var $this DefaultController */
/* @var $model CSVFile */

$this->breadcrumbs = array(
    'CSV Databases' => array('index'),
    'Select File to Upload',
);

$this->menu=array(
	array('label'=>'List CSV Databases', 'url'=>array('index')),
);
?>

<h2>Import a Database</h2>

<div class="form">
    <?php
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'upload-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )
        );
    ?>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php echo $form->fileField($model, 'file'); ?>
        <?php echo $form->error($model,'file'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'species'); ?>
        <?php echo $form->textField($model, 'species'); ?>
        <?php echo $form->error($model,'species'); ?>
    </div>
    
    <div class="row submit">
        <?php echo CHtml::submitButton('Import'); ?>
    </div>
        
    <?php $this->endWidget(); ?>
</div><!-- form -->