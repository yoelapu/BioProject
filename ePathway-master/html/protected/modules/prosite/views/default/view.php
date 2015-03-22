<?php
/* @var $this DefaultController */
/* @var $dataProvider CArrayDataProvider */
/* @var $data CArrayDataProvider */
/* @var $model Prosite */

$this->breadcrumbs = array(
    'Prosite' => array('index'),
    'Result',
);

$this->menu = array(
    array('label' => 'Search Prosite', 'url' => array('index')),
);

?>

<h2>Search Results Prosite</h2>


<?php 

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'label'=>$model->getAttributeLabel('sequence'),
            'type'=>'raw',
            'value'=>'<textarea readonly="readonly" class="dna" id="sequence">' . $model->Sequence . '</textarea>',
        ),
    ),
));

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>