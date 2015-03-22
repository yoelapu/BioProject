<?php
/* @var $this PathwayController */
/* @var $model Pathway */

$this->breadcrumbs=array(
	'Pathways'=>array('index'),
	$model->nombreruta=>array('view','id'=>$model->idtbl_rutametabolica),
	'Update',
);

$this->menu=array(
        array('label'=>'Manage Pathway', 'url'=>array('admin')),
	array('label'=>'List Pathway', 'url'=>array('index')),
	array('label'=>'Create Pathway', 'url'=>array('create')),
	array('label'=>'View Pathway', 'url'=>array('view', 'id'=>$model->idtbl_rutametabolica)),
);
?>

<h1>Update Pathway <?php echo $model->idtbl_rutametabolica; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>