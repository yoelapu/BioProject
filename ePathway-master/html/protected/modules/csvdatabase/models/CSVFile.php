<?php

class CSVFile extends CModel
{
    public $file;
    public $species;
 
    public function rules()
    {
        return array (
            array('file, species', 'required'),
            array('file', 'file',
                'types' => 'csv', 
                'wrongType'=>'Only csv allowed.',
                ),
            array('file', 'unsafe'),
        );          
    }
    
    public function attributeNames()
    {
        return array(
            'file'=>'File',
            'species'=>'Species',
            );
    }
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

?>
