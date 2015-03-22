 <?php

/**
 * This is the model class for table "tbl_ebidatabases".
 *
 * The followings are the available columns in table 'tbl_ebidatabases':
 * @property string $idtbl_ebidatabases
 * @property string $databasename
 * @property string $databasevalue
 *
 * The followings are the available model relations:
 * @property TblEbidatabasesxblastuserconfiguration[] $tblEbidatabasesxblastuserconfigurations
 */
class EBIDatabase extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TblEbidatabases the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_ebidatabases';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('databasename, databasevalue', 'required'),
            array('databasename', 'length', 'max'=>500),
            array('databasevalue', 'length', 'max'=>50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idtbl_ebidatabases, databasename, databasevalue', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'BLASTGenes' => array(self::MANY_MANY, 'BLASTGene', 'tbl_ebidatabasesxblastuserconfiguration(idtbl_ebidatabases, idtbl_blastuserconfiguration)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'idtbl_ebidatabases' => 'Idtbl Ebidatabases',
            'databasename' => 'Databasename',
            'databasevalue' => 'Databasevalue',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('idtbl_ebidatabases',$this->idtbl_ebidatabases,true);
        $criteria->compare('databasename',$this->databasename,true);
        $criteria->compare('databasevalue',$this->databasevalue,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 
?>
