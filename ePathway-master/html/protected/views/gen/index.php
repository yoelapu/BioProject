<?php
/* @var $this GenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Genes',
);

$this->menu=array(
	array('label'=>'Create Gene', 'url'=>array('create')),
	array('label'=>'Manage Genes', 'url'=>array('admin')),
        array('label' => 'Export Genes to CSV File', 'url'=>'#','linkOptions'=>array( 'onclick' => '$.fn.yiiListView.export();') ),
);

Yii::app()->clientScript->registerScript('gen-export', "
    $.fn.yiiListView.export = function() {
    $.fn.yiiListView.update('gen-view',{ 
    success: function() {
    $('#gen-view').removeClass('list-view-loading');
    window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
        });
        }", CClientScript::POS_READY);

?>

<h1>Recent Genes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
         'id' => 'gen-view',
	'itemView'=>'_view',
)); ?>
