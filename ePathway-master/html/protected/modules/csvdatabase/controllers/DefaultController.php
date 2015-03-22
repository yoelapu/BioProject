<?php
include('CustomMongoCollection.php');

class DefaultController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';
    
        // <editor-fold defaultstate="collapsed" desc="Framework related functions">
    	/**
         * @return array action filters
         */
        public function filters()
        {
                return array(
                        'accessControl', // perform access control for CRUD operations
                );
        }
        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         * @return array access control rules
         */
        public function accessRules()
        {
                return array(
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
                                'actions'=>array('index','view','error','import'),
                                'users'=>array('@'),
                        ),
                    array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('epa_master','research_master'),
			),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        ),
                );
        }
    // </editor-fold>
    
    //List all collections
    public function actionIndex() {
        $model = new MongoModel; 
        $dataProvider=new EMongoDocumentDataProvider('MongoModel', array());
        $collection_names = $model->retrieveCollectionsNames();
        
        if($collection_names != null) {
            $collection_array = $this->createArrayCollectionObject($collection_names,$model);
            $dataProvider->setData($collection_array);
        }
        
        $this->render('index', array(
            'dataProvider'=>$dataProvider,
        ));
    }
    
    /**
     * Lists all data of a specific collection
     * @param String $id Collection Name
     */
    public function actionView($id) {
        $data = array();
        $model = new MongoModel();
        $db_instance = MongoModel::model()->getDb();
        
        $collection = new MongoCollection($db_instance, $id); //ESTE VALOR DEBER PASARSE COMO PARAMETRO
        $model->setCollection($collection);
        $model->_id = $id;
        $results = MongoModel::model()->findAll();
        $columns = $this->createArrayColumns($results);
        array_shift($columns);  //Elimino la primera posicion
        
        foreach ($columns as $column) {
            $data[] = array('name'=> $column);
        }
        
        $model->initSoftAttributes($columns); //Se lo lleva candanga si no inicializo los atributos
        
        $this->render('view', array(
            //'dataProvider' => $dataProvider,
            'data' => $data,
            'model' => $model,
            'attributes' => $columns,
        ));
    }
    
    /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
    */
    public function actionDelete($id) {
        MongoModel::model()->getDb()->dropCollection($id);
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }
    
    
    public function actionError() {
        $this->render('error');
    }
        
    public function actionImport() {
        $model = new CSVFile();
        
        if (isset($_POST['CSVFile']))
        {
            $model->attributes = $_POST['CSVFile'];
            $model->file = CUploadedFile::getInstance($model, 'file');

            if (file_exists($model->file->getTempName())) {
                $this->saveFile($model->file->getTempName(), $model->species);
                $this->actionIndex();
            } 
            else {
                $this->render('error');
            }
        }
        else {
            $this->render('import', array(
                'model' => $model,
            ));
        }
    }
        
    /**
     * Save the file into MongoDB
     * @param type $pFile
     * @param type $pCollectionName
     */
    private function saveFile($pFile, $pCollectionName) {
        $db_instance = MongoModel::model()->getDb();
        $collection = new MongoCollection($db_instance, $pCollectionName);
        if (($handle = fopen($pFile, 'r')) !== FALSE) {
            $line_index = 0;
            while (($line_Array = fgetcsv($handle,',')) !== FALSE) {
                for ($index = 0; $index < count($line_Array); $index++) {
                    $data[$line_index][$index] = $line_Array[$index];
                }
                $line_index++;
            }
            fclose($handle);
            $count = count($data) - 1;
            $labels = array_shift($data);
            foreach ($labels as $label) {
                $keys[] = $label;
            }        
            for($j_index = 0; $j_index < count($data); $j_index++) {
                $model = new MongoModel();
                $model->setCollection($collection);
                $model->initSoftAttributes($keys);
                for ($i_index = 0; $i_index < count($keys); $i_index++) {
                     $model->$keys[$i_index] =  $data[$j_index][$i_index];
                }
                $model->save();
            }
        }
    }
       
    /**
     * Create an array with collection object from all the collections in mongobd
     * @param Array $pCollections
     * @param MongoModel $pModel
     * @return Array With CollectionObject
     */
    private function createArrayCollectionObject($pCollections,$pModel) {
        $db_instance = MongoModel::model()->getDb();
        foreach ($pCollections as $col) {
                $obj_collection = new CustomMongoCollection();
                $obj_collection->setCollectionName($col->getName());
                
                $new_collection = new MongoCollection($db_instance, $col->getName());
                $pModel->setCollection($new_collection);
                
                $results = MongoModel::model()->findAll();
                $columns = $this->createArrayColumns($results);
                
                $obj_collection->setCollectionColumns(implode($columns, ' '));
                $array[] = $obj_collection;
        }
        return $array;
    }
    
    /**
     * Create an array with all the columns in a specific collection
     * @param Array $pResults
     * @return Array With column names
     */
    private function createArrayColumns($pResults) {
        $array_names[] = '';
        foreach($pResults as $result) {
            $columns = $result->getSoftAttributeNames();                   
            foreach ($columns as $column) {
                if(!in_array($column, $array_names))
                    $array_names[] = $column;
            }
        }
        return $array_names;
    }
}

?>