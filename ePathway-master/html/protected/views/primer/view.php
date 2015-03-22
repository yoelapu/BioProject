<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	$model->idtbl_primer,
);

$this->menu=array(
	array('label'=>'List Primer', 'url'=>array('index')),
	//array('label'=>'Create Primer', 'url'=>array('create')),
	array('label'=>'Update Primer', 'url'=>array('update', 'id'=>$model->idtbl_primer)),
	array('label'=>'Delete Primer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idtbl_primer),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Primer', 'url'=>array('admin')),
);
?>

<h1>View Primer #<?php echo $model->idtbl_primer; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'name' => $model->getAttributeLabel('accessCode'),
                    'value' => CHtml::link(CHtml::encode($model->getAccessCode()), array('Gen/view', 'id'=>$model->idtbl_gen)),
                    'type' => 'html',
                ),
		'primerrinicio',
		'primerrlongitud',
                array(
                    'name'=>'Primer R sequence',
                    'value'=>'<textarea readonly="readonly" class="dna" id="primerr">'.$model->SequenceR . '</textarea>',
                    'type'=>'raw',
                ),
		'primerfinicio',
		'primerflongitud',
                array(
                    'name'=>'Primer F sequence', 
                    'value'=>'<textarea readonly="readonly" class="dna" id="primerr">' . $model->SequenceF . '</textarea>',
                    'type'=>'raw',
                ),
                array(
                    'name' => $model->getAttributeLabel('status'),
                    'value' => CHtml::encode($model->getPrimerStatusText()),
                ),
                'observaciones',    
                array(
                'label' => 'BLAST Search',
                'type' => 'raw',
                'value' => CHtml::link(
                    "BLAST Primer R",
                    $this->createUrl("//BLASTSearch/default/AutomaticBLAST"),
                    array(
                        "submit" => $this->createUrl("//BLASTSearch/default/AutomaticBLAST"),
                        "params" => array("Sequence" => $model->SequenceR)
                        )
                    ) . '<br/><br/>' . CHtml::link(
                    "BLAST Primer F",
                    $this->createUrl("//BLASTSearch/default/AutomaticBLAST"),
                    array(
                        "submit" => $this->createUrl("//BLASTSearch/default/AutomaticBLAST"),
                        "params" => array("Sequence" => $model->SequenceF)
                        )
                    ),
        )
	),
)); ?>