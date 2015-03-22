<?php
/* @var $this BLASTGeneController */
/* @var $model BLASTGene */

$this->breadcrumbs=array(
	'BLAST Search'=>array('..'),
	'Check Configuration',
);

$this->menu=array(
    array('label'=>'BLAST index', 'url'=>array('..')),
    array('label'=>'Modify configuration', 'url'=>array('configuration')),
);
?>

<h1>Stored BLAST configuration</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Email',
                'JobTitle',
		'SequenceType',
		'Program',
		'Scores',
		'Alignments',
		'ExpectValThreshold',
	),
)); ?>
