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
	'Gene Details'
);
?>

<h1>Details for gene <?php echo $access_code ?> </h1>

<?php
if($gene_details != NULL){
    $this->renderPartial('_genedetails',array('gene_details'=>$gene_details, 'access_code'=>$access_code));
}
else{
    echo '<h3>Gene not found. You may want to search using the buttons below:</h3>';
}

echo '<br/>';
echo '';

?>


<br/>
<ul class="big-menu">
    <li><a target="blank" href= <?php echo '"'. EBIGeneDetails::$NCBI_GENE_DETAILS_URL . $access_code . '"' ?> >This Gene on NCBI</a></li>
    <li><a target="blank" href= <?php echo '"'. EBIGeneDetails::$EBI_GENE_DETAILS_URL . $access_code . '"' ?> >This Gene on EBI</a></li>
</ul>
