<?php
/* @var $this AreainteresController */
/* @var $model Areainteres */

$this->breadcrumbs=array(
	'Relevant Areas'=>array('index'),
	'Relevant Areas by Gene',
);

$this->menu=array(
        array('label' => 'Add a Relevant Area', 'url' => array('areainteres/create','pGene' => $geneId,'pAccessCode'=>$accessCode)),	
	array('label'=>'See Recent Relevant Areas', 'url'=>array('index')),
);


?>

<h1>Relevant Areas for Gene 
    <?php echo CHtml::link($accessCode, array('gen/view','id'=>$geneId)) ?>
</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'areainteres-grid',
	'dataProvider'=>$model->searchByGene($geneId),
	'filter'=>$model,
	'columns'=>array(
                'identificador',
                'secuenciainteres',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
