<?php

class KEGGPathway extends CModel
{
    // <editor-fold defaultstate="collapsed" desc="Properties">
    
    public $Id;
    public $Entry;
    public $Name;
    public $Description;
    public $Class;
    public $Compound;
    public $Enzyme;
    public $Orthology;
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Yii related methods">
    
    public function attributeNames()
    {
        return array(
            'Entry'=>'Image',
            'Name'=>'Name',
            'Description'=>'Description',
            'Class'=>'Class',
            'Compound'=>'Compound',
            'Enzyme'=>'Enzyme',
            'Orthology' => 'Orthology',
            'Other'=>'Other'
        );
    }
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Class Methods">
    
    /**
     * Gets all information related to a metabolic 
     * pathway by its id.
     * @return \KEGGPathway model to be displayed in a CDetailView
     */
    public function search()
    {
        $model =  new KEGGPathway;
        $result = $this->getPathway($this->Id);     // gets all info
        
        $model->Entry = $result['important']['ENTRY'];
        $model->Name = $result['important']['NAME'];
        if (isset($result['important']['DESCRIPTION'])) {
            $model->Description = $result['important']['DESCRIPTION'];
        }
        if (isset($result['important']['CLASS'])) {
            $model->Class = $result['important']['CLASS'];
        }
        if (isset($result['important']['COMPOUND'])) {
            $model->Compound = $result['important']['COMPOUND'];
        }
        if (isset($result['important']['ENZYME'])) {
            $model->Enzyme = $result['important']['ENZYME'];
        }
        if (isset($result['important']['ORTHOLOGY'])) {
            $model->Orthology = $result['important']['ORTHOLOGY'];
        }
        
        // saves other information in a session variable
        Yii::app()->session['pathway_info'] = $result['other'];
        
        return $model;
    }
    
    /**
     * Access session variable 'pathway_info' to 
     * retrieve irrelevant information related to a pathway
     * @return array with other irrelevant info
     */
    public function searchOtherInfo() {
        return Yii::app()->session['pathway_info'];
    }
    
    /**
     * Searchs for a specific pathway and retrieves 
     * all information
     * @param type $pPathwayId
     * @return array with all details of such pathway
     */
    private function getPathway($pPathwayId) {
        $curl = $this->openCURLConnection(KEGGPathway::$KEGG_GET . $pPathwayId);
        $curl_result = curl_exec($curl);
        $result = preg_replace('/\n/', '<br />', $curl_result);
        curl_close($curl);
        
        $pattern = '/' . KEGGPathway::$RELEVANT_INFO . KEGGPathway::$OTHER_INFO . '/';
        $array_info = preg_split($pattern, $result, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        
        $data['important'] = array();   // stores relevant information in array_info
        $data['other'] = array();       // stores other information
        for ($index = 0; $index < count($array_info); $index = $index + 2) {
            // checks if token is relevant
            if (strpos(KEGGPathway::$RELEVANT_INFO, $array_info[$index]) !== false) {
                if ($array_info[$index] == 'ENTRY') {
                    // extracts id for the pathway image
                    $map = preg_split('/\s+/', $array_info[$index + 1]);
                    
                    $data['important'][$array_info[$index]] = 
                            "<a href=\"http://rest.kegg.jp/get/".$map[1]."/image"."\">Go to Image</a><br />";
                } else {
                    $data['important'][$array_info[$index]] = $array_info[$index + 1];       
                }
            } else {
                $data['other'][$array_info[$index]] = $array_info[$index + 1];
            }
        }
        
        return $data;
    }
    
    /**
     * Opens a connection with the specified URL
     * @param type $pURL
     * @return type curl object
     */
    private function openCURLConnection($pURL) {
        $curl = curl_init() or die(curl_error());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($curl, CURLOPT_URL, $pURL);
        
        return $curl;
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Constants">
    
    private static $KEGG_GET = "http://rest.kegg.jp/get/";
    private static $RELEVANT_INFO = "(DESCRIPTION)|(ENTRY)|(NAME)|(ENZYME)|(COMPOUND)|(CLASS)|(ORTHOLOGY)|";
    private static $OTHER_INFO = "(PATHWAY_MAP)|(REFERENCE)|(DBLINKS)|(KO_PATHWAY)|(MODULE)|(DISEASE)";
    
    // </editor-fold>
}
    
?> 