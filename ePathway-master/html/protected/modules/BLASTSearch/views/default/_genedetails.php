<?php
/* 
 * @var $this DefaultController
 * @var $gene_details
 * @var $access_code
 */



$this->widget('zii.widgets.CDetailView', array(
    'data'=>$gene_details,
    'attributes'=>array(
        'Keyword',
        'Title',
        'Author',
        'OrganismLink:html',
        'TaxonLineageLinks:html',
        'CDS',
        array(
            'label' => 'Sequence',
            'type' => 'raw',
            'value' => '<textarea readonly="readonly" class="dna" id="sequence">' . $gene_details->Sequence . '</textarea>'
        ),
        array(
            'label' => 'BLAST Search',
            'type' => 'raw',
            'value' => CHtml::link(
                    "BLAST Complete Sequence",
                    $this->createUrl("AutomaticBLAST"),
                    array(
                        "submit" => $this->createUrl("AutomaticBLAST"),
                        "params" => array("Sequence" => $gene_details->Sequence)
                        )
                    ),
        ),
        array(
            'label' => 'Save this result',
            'type' => 'raw',
            'value' => CHtml::link(
                    "Clic here to import this result into local database",
                    $this->createUrl("//gen/AutomaticCreate"),
                    array(
                        "submit" => $this->createUrl("//gen/AutomaticCreate"),
                        "params" => array(
                            'codigoaccesion' => $access_code,
                            'organismoorigen' => (string)($gene_details->Organism),
                            'secuenciacompleta' => $gene_details->Sequence,
                            'cds' => $gene_details->CDS,
                            'identificador' => $gene_details->Title,
                            )
                        )
                    ),
        )
    ),
));



?>