<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Primer', 'url'=>array('index')),
	array('label'=>'Manage Primer', 'url'=>array('admin')),
);
?>

<h1>Add a primer to Gene <?php echo $access_code; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
