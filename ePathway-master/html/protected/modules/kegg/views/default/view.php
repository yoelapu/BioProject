<?php
    /* @var $this DefaultController */
    /* @var $model KEGGPathway*/

    $this->breadcrumbs = array('Pathway Information');
    
    $this->menu=array(
        array('label'=>'View local pathways',
            'url'=>array('/pathway')),
        array('label'=>'Search in KEGG',
            'url'=>array('index')),
    );
    
    Yii::app()->clientScript->registerScript('toggle', "
    $('.info-button').click(function(){
            $('.other-info').toggle();
            return false;
    });
    ");
?>

<?php
    $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model->search(),
        'attributes'=>array(
            'Entry:html',
            'Name:html',
            'Description',
            'Class:html',
            'Compound:html',
            'Enzyme:html',
            'Orthology:html',
        ),
    ));
?>

<?php echo CHtml::link('See More Information','#', array('class'=>'info-button')); ?>
<br />
<div class="other-info" style="display:none">
<?php
    echo "<br />";
    
    foreach($model->searchOtherInfo() as $key => $value) {
        echo "<b>";
        echo CHtml::encode($key);
        echo "<br /></b><br />";
        echo $value."<br />";
    }
?>
</div>
