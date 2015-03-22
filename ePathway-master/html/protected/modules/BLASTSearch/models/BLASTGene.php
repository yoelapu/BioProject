<?php

class BLASTGene extends CActiveRecord {

    /**
     * This model is used to manage parameters for searches in the EBI NCBI BLAST service
     * 
     * also is the model class for table "tbl_blastuserconfiguration", but the persistence actions
     * should be done 'manually', via stored procedures
     * 
     * The followings are the available columns in table 'tbl_blastuserconfiguration':
     * @property string $idtbl_blastuserconfiguration
     * @property string $jobtitle
     * @property string $sequencetype
     * @property string $program
     * @property integer $scores
     * @property string $alignments
     * @property string $expectvalthreshold
     * @property string $idtbl_user
     * @property integer $idtbl_ebidatabases
     *
     * The followings are the available model relations:
     * @property TblUser $idtblUser
     * @property TblEbidatabasesxblastuserconfiguration[] $tblEbidatabasesxblastuserconfigurations
     */
    public $Email;
    public $JobTitle;
    public $SequenceType;
    public $Sequence;
    public $Program;
    public $Database;
    public $Matriz; // nuevo
    public $Scores;
    public $Alignments;
    public $ExpectValThreshold;
    public $ConfigurationId;
    public $Organism; // nuevo
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gen the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_blastuserconfiguration';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Email,Sequence', 'required', 'on' => 'blastsearch'),
            array('SequenceType,Program,Database', 'required'),
            array('Email', 'length', 'max' => 500),
            array('Scores', 'numerical', 'integerOnly' => true),
            array('JobTitle', 'length', 'max' => 500),
            array('SequenceType, Program, Alignments, ExpectValThreshold,Organism', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Email,SequenceType,Sequence,Program,Database', 'safe', 'on' => 'search'),
            array('Scores,Alignments,ExpectValThreshold,JobTitle,Organism,Matriz', 'default', 'setOnEmpty' => true, 'value' => null),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idtblUser' => array(self::BELONGS_TO, 'User', 'idtbl_user'),
            'EBIDatabases' => array(self::MANY_MANY, 'EBIDatabase', 'tbl_ebidatabasesxblastuserconfiguration(idtbl_ebidatabases, idtbl_blastuserconfiguration)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'Email' => 'e-mail',
            'JobTitle' => 'Job Title',
            'SequenceType' => 'Sequence Type',
            'Sequence' => 'Sequence',
            'Program' => 'Program',
            'Database' => 'Database',
            'Scores' => 'Scores',
            'Alignments' => 'Alignments',
            'ExpectValThreshold' => 'Expectation Value Threshold',
            'Organism' => 'Organism',
            'Matriz' => 'Matriz',
            'idtbl_blastuserconfiguration' => 'Idtbl Blastuserconfiguration',
            'idtbl_user' => 'Idtbl User',
            'idtbl_ebidatabases' => 'Idtbl Ebidatabases',
        );
    }

    public function attributeNames() {
        return array(
            'Email' => 'e-mail',
            'JobTitle' => 'Job Title',
            'SequenceType' => 'Sequence Type',
            'Sequence' => 'Sequence',
            'Program' => 'Program',
            'Database' => 'Database',
            'Scores' => 'Scores',
            'Alignments' => 'Alignments',
            'ExpectValThreshold' => 'Expectation Value Threshold',
            'Organism' => 'Organism',
            'Matriz' => 'Matriz',
        );
    }

    /**
     * Changes empty fields to null values
     * @param type $value
     * @return type
     */
    public function empty2null($value) {
        return $value === '' ? null : $value;
    }

//    public function search(){
//        $data_provider = new CArrayDataProvider(array());
//        $var = Yii::app()->getSession()->get('blast_result');
//        $var2 = Yii::app()->getSession()->get('blast_dataprovider');
//        
//        if(isset($var2)){
//            return $var2;
//        }elseif(isset($var)){
//            $data_provider = new CArrayDataProvider($var, array(
//                    'keyField'=> 'ID',
//                    'pagination' => array(
//                        'pageSize' => 20,
//                        ),
//                ));
//            Yii::app()->getSession()->add('blast_dataprovider', $data_provider);
//        }
//        return $data_provider;
//    }
    // <editor-fold defaultstate="collapsed" desc="EBI API interaction functions">
    /**
     * Requests a BLAST search from the EBI service
     * @param BLASTGene $pBlastGene
     * @return String the job id if successful
     */
    public function requestBLASTSearch($pBlastGene) {
        $service_url = BLASTGene::$BLAST_SEARCH_SERVICE_URL;
        $curl = curl_init($service_url);
        $curl_post_data = array(
            "email" => $pBlastGene->Email,
            "program" => $pBlastGene->Program, //'blastn',
            "database" => $pBlastGene->Database, //'em_rel_pln',
            "sequence" => $pBlastGene->Sequence, //"AATCGATCGATGCTAGCTAGCTGACCACACACTGTTGCTGATCGATCGTAGCTAGCTGTGTGTACTACACCACACTGACTATCG",
            "stype" => $pBlastGene->SequenceType, //'dna',
            "organism" =>$pBlastGene->Organism,
            "matrix"=>$pBlastGene->Matriz,
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        $ebi_response = curl_exec($curl);
        curl_close($curl);
        return $ebi_response;
    }

    public function getParameterDetails() {
        $service_url = 'http://www.ebi.ac.uk/Tools/services/rest/ncbiblast/run/';
        $curl = curl_init($service_url);
        $curl_post_data = array(
            "email" => '@.com',
                //"output" => 'xml',
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        $curl_response = curl_exec($curl);
        curl_close($curl);


        $xml = new SimpleXMLElement($curl_response);
        print_r($xml);
    }

    /**
     * Obtains the status for a submitted job, from the EBI service
     * @param String $pJobId
     * @return String the job status
     */
    public function getJobStatus($pJobId) {
        $service_url = BLASTGene::$BLAST_SEARCH_JOB_STATUS_URL . $pJobId;
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        $curl_response = curl_exec($curl);
        curl_close($curl);

        return $curl_response;
    }
    public function getOrganism(){
        return $Organism;
    }
    public function getXMLJobResult($pJobId) {
        if ($this->getJobStatus($pJobId) === BLASTGene::$JOB_STATUS_FINISHED) {
            $service_url = BLASTGene::$BLAST_SEARCH_RESULT_URL . $pJobId . '/xml';
            $curl = curl_init($service_url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPGET, true);

            $curl_response = curl_exec($curl);
            curl_close($curl);

            $xml = new SimpleXMLElement($curl_response);
            return $xml;
        } else {
            return null;
        }
    }

    public function getPNGJobResult($pJobId) {
        if ($this->getJobStatus($pJobId) === BLASTGene::$JOB_STATUS_FINISHED) {
            $service_url = BLASTGene::$BLAST_SEARCH_RESULT_URL . $pJobId . '/complete-visual-svg';
            $curl = curl_init($service_url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPGET, true);

            $curl_response = curl_exec($curl);
            curl_close($curl);

            return $curl_response;
        } else {
            return null;
        }
    }

    // </editor-fold>
//    public function fetchDBAttributes(){
//        $this->jobtitle = $this->JobTitle;
//        $this->sequencetype = $this->SequenceType;
//        $this->program = $this->Program;
//        $this->scores = $this->Scores;
//        $this->alignments = $this->Alignments;
//        $this->expectvalthreshold = $this->ExpectValThreshold;
//        $this->idtbl_ebidatabases = $this->Database;
//    }
    // <editor-fold defaultstate="collapsed" desc="Data access functions">
    /**
     * Stores or updates a BLAST configuration (only in the table tbl_blastuserconfiguration)
     * @param type $pUserName
     * @param type $pBLASTGene
     * @return int the id of the configuration inserted or updated
     */
    public function saveBLASTConfiguration($pUserName, $pBLASTGene) {
        $connection = Yii::app()->db;
        $call = 'SELECT * FROM saveBLASTConfiguration(:pUserName, :pJobTitle, :pSequenceType, :pProgram, :pScores, :pAlignments, :pExpectValThreshold)';
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $command = $connection->createCommand($call);
            $command->bindParam(':pUserName', $pUserName);
            $command->bindParam(':pJobTitle', $pBLASTGene->JobTitle);
            $command->bindParam(':pSequenceType', $pBLASTGene->SequenceType);
            $command->bindParam(':pProgram', $pBLASTGene->Program);
            $command->bindParam(':pScores', $pBLASTGene->Scores);
            $command->bindParam(':pAlignments', $pBLASTGene->Alignments);
            $command->bindParam(':pExpectValThreshold', $pBLASTGene->ExpectValThreshold);
            // Deberia de ir aqui el organismo, crear valor en tabla de DB
            $result = $command->queryScalar();
            $transaction->commit();

            return $result;
        } catch (Exception $e) {
            Yii::log("Error when storing configuration: " . $e->getMessage(), "error", "application.modules.BLASTSearch.models.BLASTGene");
            $transaction->rollback();
            return 0;
        }
    }

    /**
     * Obtains the complete configuration to perform a BLAST search, from the database
     * and corresponding to the current user
     * @param type $pUserNane
     * @return \BLASTGene or null if not found
     */
    public function getStoredConfiguration($pUserName) {
        $connection = Yii::app()->db;
        $call = 'SELECT * FROM getUserBLASTConfiguration(:pUserName)';
        $command = $connection->createCommand($call);
        $command->bindParam(':pUserName', $pUserName);
        $result_set = $command->queryRow();
                
        if ($result_set) {
            $blast_gene = new BLASTGene();
            $blast_gene->Email = $result_set['email'];
            $blast_gene->JobTitle = $result_set['jobtitle'];
            $blast_gene->SequenceType = $result_set['sequencetype'];
            $blast_gene->Program = $result_set['program'];
            $blast_gene->Scores = $result_set['scores'];
            $blast_gene->Alignments = $result_set['alignments'];
            $blast_gene->ExpectValThreshold = $result_set['expectvalthreshold'];
            $blast_gene->Organism = $result_set['organism'];
            $blast_gene->ConfigurationId = $result_set['idtbl_blastuserconfiguration'];

            return $blast_gene;
        }else{
            return null;
        }
    }

    /**
     * Deletes all the databases associations to the parameter Database in the default
     * BLAST search configuration for this user, using the configuration ID (the one in the database)
     * @param type $pUserName
     */
    public function deleteAllAssociatedDatabases($pConfigurationId) {
        
    }

    public function saveDatabaseAssociation($pConfigurationId, $pDatabaseName) {
        
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Constants (service URLs, parameter names...)">
    public static $REQUEST_TYPE_XML = 'xml';
    public static $JOB_STATUS_FINISHED = 'FINISHED';
    private static $BLAST_SEARCH_SERVICE_URL = 'http://www.ebi.ac.uk/Tools/services/rest/ncbiblast/run/';
    private static $BLAST_SEARCH_RESULT_URL = 'http://www.ebi.ac.uk/Tools/services/rest/ncbiblast/result/';
    private static $BLAST_SEARCH_JOB_STATUS_URL = 'http://www.ebi.ac.uk/Tools/services/rest/ncbiblast/status/';

    // </editor-fold>
}

?>
