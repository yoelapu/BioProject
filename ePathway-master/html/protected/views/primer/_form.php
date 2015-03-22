<?php
/* @var $this PrimerController */
/* @var $model Primer */
/* @var $form CActiveForm */
?>

<div class="form">
    <a href="http://primer3.ut.ee/" target="blank">Go to Primer3 website</a><br><br>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'primer-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'primerrinicio'); ?>
        <?php echo $form->textField($model, 'primerrinicio'); ?>
        <?php echo $form->error($model, 'primerrinicio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'primerrlongitud'); ?>
        <?php echo $form->textField($model, 'primerrlongitud'); ?>
        <?php echo $form->error($model, 'primerrlongitud'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'primerfinicio'); ?>
        <?php echo $form->textField($model, 'primerfinicio'); ?>
        <?php echo $form->error($model, 'primerfinicio'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'primerflongitud'); ?>
        <?php echo $form->textField($model, 'primerflongitud'); ?>
        <?php echo $form->error($model, 'primerflongitud'); ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model, 'idtbl_estadoprimer');
        echo $form->dropDownList($model, 'idtbl_estadoprimer', CHtml::listData($model->PrimerStatus, 'idtbl_estadoprimer', 'estado'), array('empty' => 'Select a status'));
        echo $form->error($model, 'idtbl_estadoprimer');
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'observaciones'); ?>
        <?php echo $form->textField($model, 'observaciones', array('size' => 60, 'maxlength' => 500)); ?>
        <?php echo $form->error($model, 'observaciones'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->