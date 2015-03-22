<?php
    /* @var $this DefaultController */
    /* @var $model Sequence */

    $this->breadcrumbs = array('Format Sequence');
?>

<h2>Format Sequence</h2>

<div class="search-form">
    
    <div class="wide form" id="format">
        
        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php
            $form = $this->beginWidget(
                'CActiveForm',
                array(
                    'id' => 'upload-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true),
                    'method'=>'post',
                )
            );
        ?>

        <div class="row">
            <?php echo $form->labelEx($model, "Sequence"); ?>
            <?php echo $form->textArea($model, "Sequence", array('class'=>'dna')); ?>
            <?php echo $form->error($model, "Sequence");  ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'Format'); ?>
            <?php
                echo $form->ListBox($model,'Format', array(
                    'Plain Sequence'=>'Plain Sequence',
                    'FASTA'=>'FASTA',
                ));
            ?>
            <?php echo $form->error($model,'Format'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, "Description"); ?>
            <?php echo $form->textField($model, "Description"); ?>
            <?php echo $form->error($model, "Description");  ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Format Sequence'); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
    
</div>

<h3>Resulting Sequence</h3>

<div class="detail-view">

<?php
    $this->widget('zii.widgets.CDetailView', array(
        'id'=>'format-detail',
        'data'=>$model->format(),
        'attributes'=>array(
            'Format',
            'Sequence:raw',
        ),
    ));
?>
    
</div>