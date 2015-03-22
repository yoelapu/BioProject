<?php

/**
 * This is the model class for table "tbl_areainteres".
 *
 * The followings are the available columns in table 'tbl_areainteres':
 * @property string $idtbl_areainteres
 * @property string $secuenciainteres
 * @property string $idtbl_gen
 * @property string $identificador
 * 
 * The followings are the available model relations:
 * @property TblGen $idtblGen
 * @property TblGen $AccessCode
 */
class Areainteres extends CActiveRecord {

    // <editor-fold defaultstate="collapsed" desc="Yii functions">
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Areainteres the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_areainteres';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('secuenciainteres, idtbl_gen', 'required'),
            array('secuenciainteres', 'length', 'max' => 1500),
            array('identificador', 'length', 'max'=>500),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('secuenciainteres, AccessCode, identificador', 'safe', 'on' => 'search'),
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
            'AccessCode' => array(self::BELONGS_TO, 'Gen', 'idtbl_gen', 'select' => array('Gen.codigoaccesion')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idtbl_areainteres' => 'Relevant area ID',
            'secuenciainteres' => 'Relevant area',
            'idtbl_gen' => 'Gene ID',
            'AccessCode' => 'Gene',
            'details' => 'View Details',
            'identificador' => 'Function',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('secuenciainteres', $this->secuenciainteres, true);
        $criteria->compare('identificador',$this->identificador,true);
        
        //criteria to search a relevant area using a gene's access code
        $criteria->with = array('AccessCode');
        $criteria->compare('"AccessCode".codigoaccesion', $this->AccessCode, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'AccessCode' => array(
                        'asc' => '"AccessCode".codigoaccesion',
                        'desc' => '"AccessCode".codigoaccesion DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Custom functions">
        
    public function searchByGene($pGeneId) {
        $criteria = new CDbCriteria;
        $criteria->compare('idtbl_gen',$pGeneId);
        
        $criteria->compare('secuenciainteres', $this->secuenciainteres, true);
        $criteria->compare('identificador',$this->identificador,true);
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    
    /**
     * returns a string with the gene's access code for this relevant area
     * @return String
     */
    public function getAccessCode() {
        return $this->AccessCode->codigoaccesion;
    }

    // </editor-fold>
}