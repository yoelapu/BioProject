<?php
    /* @var $this DefaultController */
    /* @var $data array */
?>

<div class="view">
    
    <b>
        <?php echo CHtml::encode('Identifier'); ?>:
    </b>
        <?php echo CHtml::encode($data['id']); ?>
    <br />
    <b>
        <?php echo CHtml::encode('Name'); ?>:
    </b>
        <?php echo CHtml::encode($data['name']); ?>
    <br />
    <b>
    <b> 
    <?php echo CHtml::encode('Pathways'); ?>:
    </b>
    <?php
        foreach ($data['pathways'] as $pathway) {
            if (strpos($pathway, 'path:ec') !== false ||
                    strpos($pathway, 'path:ko') !== false) {
                echo "<br />";
                echo "&nbsp&nbsp&nbsp&nbsp";
                echo CHtml::link($pathway, array(
                    "target" => "_blank",
                    'view',
                    'id' => $pathway,));
            }
        }
      ?>
    </b>
        
</div>