<?php

class EBIGeneDetails extends CModel {

    /**
     *
     * @property string $Keyword
     * @property string $Sequence
     * 
     */
    public $Keyword;
    public $Title;
    public $Author;
    public $Organism;
    public $TaxonLineage;
    //these two properties are used to store an EBI link representatation
    //of $Organism and $TaxonLineage
    public $OrganismLink;
    public $TaxonLineageLinks;
    public $CDS;
    public $Sequence;

    // <editor-fold defaultstate="collapsed" desc="Methods">
    /**
     * Singleton pattern implementation
     */
    public static function getInstance() {
        if (!isset(EBIGeneDetails::$_Instance))
            EBIGeneDetails::$_Instance = new EBIGeneDetails();

        return EBIGeneDetails::$_Instance;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gen the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                //array('Email,SequenceType,Sequence,Program,Database', 'required'),
                //array('Email', 'length', 'max' => 500),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                //array('Email,SequenceType,Sequence,Program,Database', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'Keyword' => 'Keyword',
            'Title' => 'Title',
            'Author' => 'Author(s)',
            'Organism' => 'Organism',
            'TaxonLineage' => 'Lineage',
            'OrganismLink' => 'Organism',
            'TaxonLineageLinks' => 'TaxonLineage',
            'CDS' => 'CDS location',
            'Sequence' => 'Sequence',
        );
    }

    public function attributeNames() {
        return array(
            'Keyword' => 'Keyword',
            'Title' => 'Title',
            'Author' => 'Author',
            'Organism' => 'Organism',
            'TaxonLineage' => 'Lineage',
            'OrganismLink' => 'OrganismL',
            'TaxonLineageLinks' => 'LineageL',
            'CDS' => 'CDS',
            'Sequence' => 'Sequence',
        );
    }

    // <editor-fold defaultstate="collapsed" desc="EBI API interaction functions">
    public function getEBIGeneDetails($pGeneAccessCode) {
        $service_url = EBIGeneDetails::$EBI_GENE_DETAILS_URL . $pGeneAccessCode . '&display=xml';
        $curl = curl_init($service_url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $curl_response = curl_exec($curl);
        curl_close($curl);

        $xml = new SimpleXMLElement($curl_response);
        
        if(@count($xml->children()) > 0){
            //obtains an object that maps the xml response
            return $this->getEBIGeneDetailsFromSimpleXMLElement($xml);
        }else{
            return null;
        }
    }

    public function getEBIGeneDetailsFromSimpleXMLElement($pSimpleXMLElement) {
        $gene_details = new EBIGeneDetails();

        //entry is the node that contains all the relevant info
        $xml_details = $pSimpleXMLElement->children()->entry;

        $gene_details->Keyword = $xml_details->keyword;
        //reference details
        $gene_details->Title = $xml_details->reference->title;
        //obtains the authors
        if ($xml_details->reference->author) {
            foreach ($xml_details->reference->author as $author)
                $authors[] = $author;
            $gene_details->Author = implode(', ', $authors);
        }

        //Feature details
        //this loop might look a little dark, it's because both CDS and lineage
        //appear as 'feature' node, so they must be reached via a for
        //and check on each iteration if they are present
        foreach ($xml_details->feature as $feature) {
            if ($feature->taxon) {
                $gene_details->Organism = $feature->taxon->attributes()->{'scientificName'};

                //obtains the lineages
                $feature_taxon = $feature->taxon;
                if ($feature_taxon) {
                    foreach ($feature_taxon->lineage->taxon as $lineage)
                        $taxon_lineage[] = $lineage->attributes()->{'scientificName'};
                    $gene_details->TaxonLineage = $taxon_lineage; //implode(', ', $taxon_lineage);
                }
            }
            
            if($feature->attributes()->{'name'} == 'CDS'){
                $gene_details->CDS = $feature->attributes()->{'location'};
            }
        }

        
        //and the sequence (without spaces)
        $gene_details->Sequence = preg_replace('/\s+/', '', $xml_details->sequence);

        //adds the taxon links (for organism and lineage)
        $gene_details->addTaxonLinks();

        return $gene_details;
    }

    /**
     * Gives URL format to the properties $OrganismLink and $TaxonLineageLinks
     */
    private function addTaxonLinks() {
        $this->OrganismLink =
                '<a target="blank" href="' .
                EBIGeneDetails::$EBI_TAXON_URL .
                $this->Organism . '">' .
                $this->Organism . '</a>';

        foreach ($this->TaxonLineage as $lineage) {
            $lineage_links[] = '<a target="blank" href=' .
                    EBIGeneDetails::$EBI_TAXON_URL .
                    $lineage . '">' .
                    $lineage . '</a>';
        }
        $this->TaxonLineageLinks = implode(', ', $lineage_links);
    }

    // </editor-fold>
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Private Attributes">
    private static $_Instance; //for singleton
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Constants (service URLs, parameter names...)">
    public static $EBI_GENE_DETAILS_URL = 'http://www.ebi.ac.uk/ena/data/view/';
    public static $NCBI_GENE_DETAILS_URL = 'http://www.ncbi.nlm.nih.gov/nucest/';
    
    private static $EBI_TAXON_URL = 'http://www.ebi.ac.uk/ena/data/view/Taxon:';
    // </editor-fold>
}

?>