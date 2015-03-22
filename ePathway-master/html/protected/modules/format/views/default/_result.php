<?php
    /* @var $this DefaultController */
    /* @var $data array */
?>

<div class="view">
    
    <b>
        <?php echo CHtml::encode('Format'); ?>:
    </b>
        <?php echo CHtml::encode($data['format']); ?>
    <br />
    <b>
        <?php echo CHtml::encode('Sequence'); ?>:
    </b>
        <?php 
        echo CHtml::textArea('result', $data['sequence'], array(
            'readonly'=>'readonly',
        )); ?>
    <br />
        
</div>