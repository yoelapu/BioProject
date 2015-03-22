<?php
/* @var $this DefaultController */
/* @var $model MongoModel */
/* @var $form CActiveForm */
/* @var $data array */
/* @var $attributes array */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    
<?php
    foreach ($attributes as $attribute) {
        echo "<div class=\"row\">";
        echo $form->label($model, $attribute);
        echo $form->textField($model, $attribute);
        echo "</div>";
    }
?>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
