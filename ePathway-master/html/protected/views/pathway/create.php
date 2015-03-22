<?php
/* @var $this PathwayController */
/* @var $model Pathway */

$this->breadcrumbs=array(
	'Pathways'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pathway', 'url'=>array('index')),
	array('label'=>'Manage Pathway', 'url'=>array('admin')),
);
?>

<h1>Create Pathway</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>