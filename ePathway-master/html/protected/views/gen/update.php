<?php
/* @var $this GenController */
/* @var $model Gen */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	$model->codigoaccesion,
	'Update',
);

$this->menu=array(
	array('label'=>'List Genes', 'url'=>array('index')),
	array('label'=>'Create Gene', 'url'=>array('create')),
	array('label'=>'View Gene', 'url'=>array('view', 'id'=>$model->idtbl_gen)),
	array('label'=>'Manage Genes', 'url'=>array('admin')),
);
?>

<h1>Update Gene <?php echo $model->codigoaccesion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>