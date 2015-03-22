<?php
/* @var $this PathwayController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pathways',
);

$this->menu=array(
	array('label'=>'Create Pathway', 'url'=>array('create')),
	array('label'=>'Manage Pathway', 'url'=>array('admin')),
        array('label'=>'Search in KEGG', 'url'=>array('/kegg')),
        array('label' => 'Export Pathways to CSV File', 'url'=>'#','linkOptions'=>array( 'onclick' => '$.fn.yiiListView.export();') ),
);

Yii::app()->clientScript->registerScript('pathways-export', "
    $.fn.yiiListView.export = function() {
    $.fn.yiiListView.update('Pathways-view',{ 
    success: function() {
    $('#Pathways-view').removeClass('list-view-loading');
    window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
        });
        }", CClientScript::POS_READY);

?>

<h1>Pathways</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'id' => 'Pathways-view',
	'itemView'=>'_view',
)); ?>
