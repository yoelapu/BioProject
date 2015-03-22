<?php
    /* @var $this DefaultController */
    /* @var $dataProvider EMongoDocumentDataProvider */
    /* @var $data array */
    /* @var $model MongoModel */
    /* @var $attributes array */

    $this->breadcrumbs = array(
        'CSV Databases' =>array('index'),
        'View Database'
    );

    $this->menu=array(
        array('label'=>'Import CSV', 'url'=>array('import')),
        array('label'=>'List CSV Databases', 'url'=>array('index')),
        array('label' => 'Delete Database', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->_id), 'confirm' => 'Are you sure you want to delete this database?')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
    });
    $('.search-form form').submit(function(){
            $('#csv-grid').yiiGridView('update', {
                    data: $(this).serialize()
            });
            return false;
    });
    ");
?>

<h2>View a local information</h2>

<?php 
echo CHtml::link('Advanced Search','#', array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php 
    $this->renderPartial('_search', array(
        'model'=> $model,
        'attributes' => $attributes,
    )); 
?>
</div><!-- search-form -->

<div class="extended-grid">
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'csv-grid',
        'dataProvider' => $model->searchData(),
        'columns' =>  $data,
    )); 
?>
</div>