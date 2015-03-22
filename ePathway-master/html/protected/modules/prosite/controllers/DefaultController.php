<?php

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
                                'actions'=>array('BadSequence','index'),
                                'users'=>array('@'),
                        ),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        ),
                );
        }
    // </editor-fold>
    
    //Call the error page
    public function actionBadSequence() {
        $this->render('badsequence');
    }

    
    //Show the form, and calls the view with the results obtained
    public function actionIndex() {
        $model = new Prosite();
        if(isset($_POST['Prosite'])) {
            $model->attributes = $_POST['Prosite'];
             if ($model->validate()) {
                $json_result = $model->requestPrositeSearch($model);
                $json_result_decode = json_decode($json_result,true);
                 if($json_result_decode['n_match'] == 0) {
                     $this->render('badsequence');
                 }
                 else {
                     $prosite_result_items = PrositeResultItem::getInstance()->getPrositeResultItemFromJSONResult($json_result_decode,$model->Sequence);
                     $prosite_data_provider = new CArrayDataProvider('PrositeResultItem', array(
                         'data' => $prosite_result_items,
                         'id' => 'prosite-search-result',
                         'keyField' => 'ID',
                         'pagination' => array(
                             'pageSize' => 10,
                             )));
                     $this->render('view',array('model' =>$model,
                         'dataProvider'=>$prosite_data_provider,));
                 }
            }
        }
        else
            $this->render('index',array('model' => $model,));
    }
}

?>