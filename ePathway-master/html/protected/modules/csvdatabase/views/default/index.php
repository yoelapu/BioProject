<?php
    /* @var $this DefaultController */
    /* @var $dataProvider EMongoDocumentDataProvider */
    /* @var $data EMongoDocumentDataProvider */

    $this->breadcrumbs = array('CSV Databases');
    $this->menu=array(
        array('label'=>'Import CSV', 'url'=>array('import')));
?>

<h2>Available Databases</h2>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>