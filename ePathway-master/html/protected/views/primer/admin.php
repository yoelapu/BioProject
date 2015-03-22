<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Primers', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#primer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Primers</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'primer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array( 
                    'name'=>'accessCode', 
                    'value'=> '$data->accessCode->codigoaccesion'
                ),
		'primerrinicio',
		'primerrlongitud',
		'primerfinicio',
		'primerflongitud',
		'observaciones',
                //array('name' => 'Status', 'value' => $model->getStatusFromStatusId($model->idtbl_estadoprimer)),
                array( 
                    'name'=>'status', 
                    'value'=> '$data->status->estado'
                ),
                array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
