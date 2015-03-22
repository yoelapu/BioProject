<?php

class PrositeResultItem {

    // <editor-fold defaultstate="collapsed" desc="Properties">
    public $Start; //Position where the interest area is started
    public $Stop; //Position where the interest area is stopped
    public $Score; //
    public $SignatureAC; //Link to a documentation about the protein
    public $ID;
    public $Link;
    public $Sequence;
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Methods">
    
    /**
     * Singleton pattern implementation
     */
    public static function getInstance(){
        if(!isset(PrositeResultItem::$_Instance))
            PrositeResultItem::$_Instance = new PrositeResultItem();
        
        return PrositeResultItem::$_Instance;
    }
    
     public function attributeNames() {
        return array(
            'Start' => 'Start',
            'Stop' => 'Stop',
            'Score' => 'Score',
            'SignatureAC' => 'Signature_ac',
            'Sequence' => 'Sequence',
            'Link' => 'Link'
        );
     }
     
      /**
     * Create an array from a Json objetct.
     * @param JSON Objet $pJson.
     * @return ArrayObject The results data.
     */
    public function getPrositeResultItemFromJSONResult($pJson, $pSequence) {
        $result = array();
        foreach($pJson['matchset'] as $key) {
            $prosite_result_item = new PrositeResultItem();
            $prosite_result_item ->Start = $key['start'];
            $prosite_result_item->Stop = $key['stop'];
            $prosite_result_item->SignatureAC = $key['signature_ac'];
            $prosite_result_item->Link = PrositeResultItem::$PROSITE_DOCUMENTATION_URL. $key['signature_ac'];
            $prosite_result_item->Sequence = substr(preg_replace('/\s+/', '', $pSequence), $key['start'] - 1,$key['stop'] - $key['start'] + 1);
            if(array_key_exists('score',$key))
                $prosite_result_item->Score = $key['score'];
            $result[] = $prosite_result_item;
        }        
        return $result;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Private Attributes">
    private static $_Instance;
    // </editor-fold>
       
    // <editor-fold defaultstate="collapsed" desc="Constants">
    private static $PROSITE_DOCUMENTATION_URL = 'http://prosite.expasy.org/cgi-bin/prosite/nicedoc.pl?';
    // </editor-fold>
}

?>
