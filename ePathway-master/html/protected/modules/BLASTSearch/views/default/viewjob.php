<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>
    


    
    
    $(document).ready(function() {
        var job_status = $('#job-status').html();
    if($.trim(job_status) != 'FINISHED'){
        window.onload = setupRefresh;
    }else{
        document.title = 'READY - ePathway';
    }
});
    
    function setupRefresh() {
  setTimeout("refreshPage();", 25000);
}
function refreshPage() {
   window.location = location.href;
}

</script>

<?php
/* 
 * @var $this DefaultController
 * @var $job_status The status for the current job, provided by EBI service
 * @var $job_id
 * @var $blast_data_provider
 * @var $result_columns
 */
$this->menu=array(
        array('label'=>'BLAST index', 'url'=>array('index')),
        array('label'=>'BLAST search', 'url'=>array('blastsearch')),
        array('label'=>'Modify configuration', 'url'=>array('BLASTGene/configuration')),
        array('label'=>'View stored configuration', 'url'=>array('BLASTGene/viewConfiguration')),
    );

$this->breadcrumbs=array(
        $this->module->id => array('index'),
	'Job Status'
);
//echo $organismo;
?>

<h1>Job <span id="job-status"> <?php echo $job_status ?> </span> </h1>
<h3>Job's ID: <?php echo $job_id ?> </h3> 



<div class="extended-grid" id="blast-result">
<?php

if($job_status === BLASTGene::$JOB_STATUS_FINISHED && $blast_data_provider != null){
    echo '<p>Move the cursor over the table to display the columns completely</p>';
    
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'blast-result-grid',
        'dataProvider' => $blast_data_provider,
        'columns'=> /*$result_columns*/ array(
            'Database',
            array(
                'name' => 'ID',
                'value' => 'CHtml::link($data->ID,array("viewgenedetails", "pGeneAccessCode"=>$data->ID))', //'$data->ID',
                'type' => 'raw',
                ),
            array(
                'name' => 'AC',
                'value' => 'CHtml::link($data->AC,array("viewgenedetails", "pGeneAccessCode"=>$data->AC))', //'$data->ID',
                'type' => 'raw',
                ),
            'Length',
            'Score',
            'Expectation',
            'Identity',
            'Gaps',
            'Bits',
            'Description'
        )
    ));
//    echo $job_image_result;
}
?>
</div>
