<?php
/* @var $this AreainteresController */
/* @var $model Areainteres */

$this->breadcrumbs=array(
	'Relevant Areas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Relevant Areas', 'url'=>array('index')),
	array('label'=>'Manage Relevant Areas', 'url'=>array('admin')),
);
?>

<h1>Add Relevant Area to Gene <?php echo $access_code ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>