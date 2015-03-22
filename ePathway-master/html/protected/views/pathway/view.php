<?php
/* @var $this PathwayController */
/* @var $model Pathway */

$this->breadcrumbs=array(
	'Pathways'=>array('index'),
	$model->nombreruta,
);

$this->menu=array(
        array('label'=>'Manage Pathway', 'url'=>array('admin')),
	array('label'=>'List Pathway', 'url'=>array('index')),
	array('label'=>'Create Pathway', 'url'=>array('create')),
	array('label'=>'Update Pathway', 'url'=>array('update', 'id'=>$model->idtbl_rutametabolica)),
	array('label'=>'Delete Pathway', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idtbl_rutametabolica),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Pathway <?php echo $model->nombreruta; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombreruta',
                array(
                    'label' => CHtml::encode($model->getAttributeLabel('urlruta')),
                    'type' => 'raw',
                    'value' => CHtml::link(CHtml::encode($model->urlruta), CHtml::encode($model->urlruta)),
                ),
	),
)); ?>
