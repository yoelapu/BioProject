<?php
/* @var $this BLASTGeneController */
/* @var $model BLASTGene */

/* http://localhost/ePathway/index.php/BLASTSearch/BLASTGene/create */

$this->breadcrumbs=array(
	'Blastgenes'=>array('..'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List BLASTGene', 'url'=>array('index')),
	//array('label'=>'Manage BLASTGene', 'url'=>array('admin')),
);
?>

<h1>Create BLASTGene</h1>

<?php echo $this->renderPartial('/BLASTGene/_form', array('model'=>$model)); ?>