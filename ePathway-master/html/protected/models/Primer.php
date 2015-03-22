<?php

/**
 * This is the model class for table "tbl_primer".
 *
 * The followings are the available columns in table 'tbl_primer':
 * @property string $idtbl_primer
 * @property integer $primerrinicio
 * @property integer $primerrlongitud
 * @property integer $primerfinicio
 * @property integer $primerflongitud
 * @property string $observaciones
 * @property string $idtbl_gen
 * @property string $idtbl_estadoprimer
 *
 * The followings are the available model relations:
 * @property TblGen $idtblGen
 * @property TblGen $accessCode
 * @property TblGen $completeSequence
 * 
 * @property TblEstadoprimer $idtblEstadoprimer
 * @property TblEstadoprimer $status
 * 
 * @property $PrimerStatus Primer Status List
 */
class Primer extends CActiveRecord {

    //used to pass the primer status to some views
    public $PrimerStatus;
    //the primer's nucleotide sequence
    public $SequenceF;
    public $SequenceR;
    
    // <editor-fold defaultstate="collapsed" desc="Yii functions">
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Primer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_primer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('primerrinicio, primerrlongitud, primerfinicio, primerflongitud, idtbl_gen, idtbl_estadoprimer', 'required'),
            array('primerrinicio, primerrlongitud, primerfinicio, primerflongitud', 'numerical', 'integerOnly' => true),
            array('observaciones', 'length', 'max' => 500),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('primerrinicio, primerrlongitud, primerfinicio, primerflongitud, observaciones, accessCode, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idtblGen' => array(self::BELONGS_TO, 'TblGen', 'idtbl_gen'),
            'accessCode' => array(self::BELONGS_TO, 'Gen', 'idtbl_gen', 'select' => array('Gen.codigoaccesion')),
            'completeSequence' => array(self::BELONGS_TO, 'Gen', 'idtbl_gen', 'select' => array('Gen.secuenciacompleta')),
            
            'idtblEstadoprimer' => array(self::BELONGS_TO, 'TblEstadoprimer', 'idtbl_estadoprimer'),
            'status' => array(self::BELONGS_TO, 'EstadosPrimer', 'idtbl_estadoprimer', 'select' => array('EstadosPrimer.estado')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idtbl_primer' => 'Idtbl Primer',
            'primerrinicio' => 'Primer R Start',
            'primerrlongitud' => 'Primer R Length',
            'primerfinicio' => 'Primer F Start',
            'primerflongitud' => 'Primer F Length',
            'observaciones' => 'Observations',
            'idtbl_gen' => 'Gene',
            'idtbl_estadoprimer' => 'Primer Status',
            'accessCode' => 'Gene',
            'completeSequence' => 'Complete Sequence',
            'status' => 'Primer Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('primerrinicio', $this->primerrinicio);
        $criteria->compare('primerrlongitud', $this->primerrlongitud);
        $criteria->compare('primerfinicio', $this->primerfinicio);
        $criteria->compare('primerflongitud', $this->primerflongitud);
        $criteria->compare('observaciones', $this->observaciones, true);
        
        //added for searching by gene access code and primer status
        $criteria->with = array('accessCode','status');
        $criteria->compare('"accessCode".codigoaccesion', $this->accessCode, true);
        //added for searching by primer status
        $criteria->compare('"status".estado', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'accessCode' => array(
                        'asc' => '"accessCode".codigoaccesion',
                        'desc' => '"accessCode".codigoaccesion DESC',
                    ),
                    'status' => array(
                        'asc' => '"status".estado',
                        'desc' => '"status".estado DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }
    
    public function searchByGene($pGeneId){
        $criteria = new CDbCriteria;
        $criteria->compare('idtbl_gen',$pGeneId); 

        $criteria->compare('primerrinicio', $this->primerrinicio);
        $criteria->compare('primerrlongitud', $this->primerrlongitud);
        $criteria->compare('primerfinicio', $this->primerfinicio);
        $criteria->compare('primerflongitud', $this->primerflongitud);
        $criteria->compare('observaciones', $this->observaciones, true);
        
        //added for searching by primer status
        $criteria->with = array('status');
        $criteria->compare('"status".estado', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'status' => array(
                        'asc' => '"status".estado',
                        'desc' => '"status".estado DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="DNA Actions">
    /**
     * Obtains a pair of sequences for primers, from a given start index and length
     * @param type $pModel
     */
    public function setPrimerPairSequence($pModel){
        $index_primerF = $pModel->primerfinicio - 1;
        $index_PrimerR = $pModel->primerrinicio - 1;
        
        $pModel->SequenceF = substr($this->getCompleteSequence(), $index_primerF, $index_primerF + $pModel->primerflongitud);
        $pModel->SequenceR = substr($this->getCompleteSequence(), $index_PrimerR, $index_PrimerR + $pModel->primerrlongitud);
    }
    
    /**
     * returns a string with the gene's access code for this relevant area
     * @return String
     */
    public function getAccessCode() {
        return $this->accessCode->codigoaccesion;
    }
    
    /**
     * returns a string with the gene's complete sequence
     * @return String
     */
    public function getCompleteSequence(){
        return $this->completeSequence->secuenciacompleta;
    }
    
    /**
     * returns the status of a primer, to display it
     */
    public function getPrimerStatusText(){
        return $this->status->estado;
    }
    // </editor-fold>
        
    // <editor-fold defaultstate="collapsed" desc="Persistence or DB custom actions">
    
    /**
     * Retrieves a list of posible status for a primer
     * @return $result an array analogue to tbl_EstadoPrimer
     */
    public function retrievePrimerStatusList(){
        $call = 'SELECT * FROM getprimerstatuslist()';
        $connection = Yii::app()->db;
        $command = $connection->createCommand($call);
        //$command->bindParam(':pIdProyecto', $pIdProyecto, PDO::PARAM_INT);
        $result = $command->queryAll();

        if ($result == false)
            return null;
        else {
            return $result;
        }
    }
     
    // </editor-fold>
}