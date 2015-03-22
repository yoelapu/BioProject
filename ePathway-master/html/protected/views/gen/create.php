<?php
/* @var $this GenController */
/* @var $model Gen */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Genes', 'url'=>array('index')),
	array('label'=>'Manage Genes', 'url'=>array('admin')),
);
?>

<h1>Create Gene</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>