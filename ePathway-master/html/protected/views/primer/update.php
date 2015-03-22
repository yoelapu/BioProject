<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	$model->idtbl_primer=>array('view','id'=>$model->idtbl_primer),
	'Update',
);

$this->menu=array(
	array('label'=>'List Primer', 'url'=>array('index')),
	array('label'=>'Create Primer', 'url'=>array('create')),
	array('label'=>'View Primer', 'url'=>array('view', 'id'=>$model->idtbl_primer)),
	array('label'=>'Manage Primer', 'url'=>array('admin')),
);
?>

<h1>Update Primer <?php echo $model->idtbl_primer; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>