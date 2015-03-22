<?php
/* @var $this PrimerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Primers',
);

$this->menu=array(
	array('label'=>'Manage Primer', 'url'=>array('admin')),
        array('label' => 'Export Primers to CSV File', 'url'=>'#','linkOptions'=>array( 'onclick' => '$.fn.yiiListView.export();') ),
);

Yii::app()->clientScript->registerScript('primer-export', "
    $.fn.yiiListView.export = function() {
    $.fn.yiiListView.update('primer-view',{ 
    success: function() {
    $('#primer-view').removeClass('list-view-loading');
    window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
        });
        }", CClientScript::POS_READY);


?>

<h1>Primers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'id' => 'primer-view',
	'itemView'=>'_view'
)); ?>
