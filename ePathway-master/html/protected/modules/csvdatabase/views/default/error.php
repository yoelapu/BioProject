<?php
/* @var $this DefaultController */
/* @var $model CSVFile */

    $this->breadcrumbs = array(
        'Import'=>array('index'),
        'Import Failed',
    );

    $this->menu=array(
        array('label'=>'Import CSV', 'url'=>array('import')),
        array('label'=>'View Local Data', 'url'=>array('index')),
    );
?>

<h2>Import Failed. Try again later.</h2>