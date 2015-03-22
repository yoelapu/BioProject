<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	'Primers by Gene',
);

$this->menu=array(
    array('label' => 'Add a primer', 'url' => array('primer/create','id' => $geneId,'pAccessCode'=>$accessCode)),	
    array('label'=>'See All Primers', 'url'=>array('index')),
);
?>

<h1>Primers for Gene 
    <?php echo CHtml::link($accessCode, array('gen/view','id'=>$geneId)) ?>
</h1>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'primer-grid',
	'dataProvider'=>$model->searchByGene($geneId),//$dataProvider,
	'filter'=>$model,
	'columns'=>array(
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
)); 
    ?>
