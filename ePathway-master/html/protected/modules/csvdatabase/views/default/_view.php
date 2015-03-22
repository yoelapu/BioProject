<?php
/* @var $this DefaultController */
/* @var $data MongoModel */
?>

<div class="view">

        <b><?php echo CHtml::encode('Database Name'); ?>:</b>
	<?php echo CHtml::encode($data->getCollectionName()); ?>
	<br />
        
        <b><?php echo CHtml::encode('Available Columns'); ?>:</b>
	<?php echo CHtml::encode($data->getCollectionColumns()); ?>
	<br />
    
        <?php echo CHtml::link('View Data',array('view','id'=>$data->getCollectionName())) ?>
        
</div>