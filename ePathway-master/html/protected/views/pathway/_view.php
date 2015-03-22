<?php
/* @var $this PathwayController */
/* @var $data Pathway */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreruta')); ?>:</b>
	<?php echo CHtml::encode($data->nombreruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('urlruta')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->urlruta), CHtml::encode($data->urlruta)); ?>
	<br />
        
        <?php echo CHtml::link('See details', array('view', 'id'=>$data->idtbl_rutametabolica)); ?>
	<br />


</div>