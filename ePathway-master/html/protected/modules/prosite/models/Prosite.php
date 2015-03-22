<?php

class Prosite extends CModel {
    
    // <editor-fold defaultstate="collapsed" desc="Properties">
    public $Sequence;
    // </editor-fold>
        
    // <editor-fold defaultstate="collapsed" desc="Methods">
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gen the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Sequence', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Sequence', 'safe', 'on' => 'search'),
        );
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'Sequence' => 'Sequence',
        );
    }

    /**
     * @return array customized attribute names
     */
    public function attributeNames() {
        return array(
            'Sequence' => 'Sequence',
        );
    }
    
    /**
     * Create a connection with ExPASy using curl, and returns the results obtained.
     * @param Prosite $pProsite Prosite model.
     * @return ArrayObject The results data obtained.
     */
    public function requestPrositeSearch($pProsite) {
        $service_url = Prosite::$PROSITE_SEARCH_SERVICE_URL;  
        $curl = curl_init($service_url);
        $curl_post_data = array(
            Prosite::$PARAMETER_SEQUENCE => $pProsite->Sequence,
            Prosite::$PARAMETER_OUTPUT => Prosite::$REQUEST_TYPE
            );
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($curl, CURLOPT_POST, true);
       curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
       $prosite_response = curl_exec($curl);
       curl_close($curl);
       return $prosite_response;
    }
     
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Constants">
    private static $REQUEST_TYPE = 'json';
    
    private static $PARAMETER_SEQUENCE =  'seq';
    private static $PARAMETER_OUTPUT = 'output';
    private static $PROSITE_SEARCH_SERVICE_URL = 'http://prosite.expasy.org/cgi-bin/prosite/PSScan.cgi';
    // </editor-fold>

}

?>
