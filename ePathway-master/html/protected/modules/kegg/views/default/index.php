<?php
    /* @var $model KEGGCompound */

    $this->breadcrumbs = array('Search in KEGG');
    
    $this->menu=array(
        array('label'=>'View local pathways', 'url'=>array('/pathway')),
    );
?>

<h2>Search in KEGG</h2>

<div class="search-form">
    
    <div class="wide form">

        <?php $form=$this->beginWidget(
            'CActiveForm', 
            array(
                'action'=>Yii::app()->createUrl($this->route),
                'id' => 'search-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true),
                'method'=>'get',
        )); ?>

        <div class="row">
            <?php echo $form->label($model, "CompoundName"); ?>
            <?php echo $form->textField($model, "CompoundName"); ?>
            <?php echo $form->error($model, "CompoundName");  ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Search'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
    
</div>

<div class="list-view">
    
    <?php
        $this->widget('zii.widgets.CListView', array(
            'id' => 'kegg-list',
            'dataProvider' => $model->search(),
            'itemView' => '_view',
            'ajaxUpdate' => true,
        ));
    ?>

</div>