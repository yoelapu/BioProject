<?php
/* @var $this DefaultController */
/* @var $data PrositeResultItem */
?>

<div class="view">

    <b><?php echo CHtml::encode('Start'); ?>:</b>
        <?php echo CHtml::encode($data->Start); ?>
    <br />
    
    <b><?php echo CHtml::encode('Stop'); ?>:</b>
        <?php echo CHtml::encode($data->Stop); ?>
    <br />
    
    <b><?php echo CHtml::encode('Signature_ac'); ?>:</b>
        <?php echo CHtml::link($data->SignatureAC,$data->Link ,array('target'=>'_blank')) ?>
    <br />    
    
    <b><?php echo CHtml::encode('Score'); ?>:</b>
        <?php echo CHtml::encode($data->Score); ?>
    <br />    
              
    <b><?php echo CHtml::encode('Sequence'); ?>:</b>
        <?php echo CHtml::encode($data->Sequence); ?>
    <br />

</div>