<?php
/* 
 * @var $this DefaultController
 */
$this->menu=array(
        array('label'=>'BLAST index', 'url'=>array('index')),
        array('label'=>'BLAST search', 'url'=>array('blastsearch')),
        array('label'=>'Modify configuration', 'url'=>array('BLASTGene/configuration')),
        array('label'=>'View stored configuration', 'url'=>array('BLASTGene/viewConfiguration')),
    );

$this->breadcrumbs=array(
        $this->module->id => array('index'),
	'Processing'
);
?>

<h1>Please wait</h1>
<h3>Your request is being processed</h3>
