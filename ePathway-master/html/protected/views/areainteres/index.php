<?php
/* @var $this AreainteresController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Relevant Areas',
);

$this->menu=array(
	array('label'=>'Manage Relevant Areas', 'url'=>array('admin')),
        array('label' => 'Export Relevant Areas to CSV File', 'url'=>'#','linkOptions'=>array( 'onclick' => '$.fn.yiiListView.export();') ),
);

Yii::app()->clientScript->registerScript('relevantareas-export', "
    $.fn.yiiListView.export = function() {
    $.fn.yiiListView.update('relevantareas-view',{ 
    success: function() {
    $('#relevantareas-view').removeClass('list-view-loading');
    window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
        });
        }", CClientScript::POS_READY);

?>

<h1>Relevant Areas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'id' => 'relevantareas-view',
	'itemView'=>'_view',
)); ?>
