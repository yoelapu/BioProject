<?php

class DefaultController extends Controller 
{
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
                'actions'=>array('index','view'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    // </editor-fold>
    
    public function actionIndex()
    {
        $model = new KEGGCompound;
        
        $this->render('index', array(
            'model'=>$model,
        ));
    }
    
    public function actionView($id)
    {
        $model = new KEGGPathway;
        $model->Id = $id;

        $this->render('view', array(
            'model'=>$model,
        ));
    }
}

?>
