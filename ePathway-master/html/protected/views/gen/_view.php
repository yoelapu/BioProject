<?php
/* @var $this GenController */
/* @var $data Gen */
?>

<div class="view">

        <b><?php echo CHtml::encode($data->getAttributeLabel('identificador')); ?>:</b>
	<?php echo CHtml::encode($data->identificador); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('codigoaccesion')); ?>:</b>
	<?php echo CHtml::encode($data->codigoaccesion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organismoorigen')); ?>:</b>
	<?php echo CHtml::encode($data->organismoorigen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('secuenciacompleta')); ?>:</b>
	<?php echo CHtml::encode($data->secuenciacompleta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cds')); ?>:</b>
	<?php echo CHtml::encode($data->cds); ?>
	<br />
        <?php echo CHtml::link('View Details',array('gen/view','id'=>$data->idtbl_gen)) ?>


</div>