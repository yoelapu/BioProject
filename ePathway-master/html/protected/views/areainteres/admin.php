<?php
/* @var $this AreainteresController */
/* @var $model Areainteres */

$this->breadcrumbs=array(
	'Relevant Areas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Relevant Areas', 'url'=>array('index')),
);


?>

<h1>Manage Relevant Areas</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'areainteres-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array( 
                    'name'=>'AccessCode', 
                    'value'=> '$data->AccessCode->codigoaccesion'
                    ),
                'identificador',
                'secuenciainteres',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
