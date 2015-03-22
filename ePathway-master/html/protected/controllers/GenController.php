<?php

class GenController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array(),
//				'users'=>array('*'),
//			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update', 'admin', 'filter','AutomaticCreate', 'ExportFile'),
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
       
        
        
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model=new Gen;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gen']))
		{
			$model->attributes=$_POST['Gen'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idtbl_gen));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        
        /**
         * This actions allow the user to create a new gen from a link
         * e.g. the one in the details when doing an EBI BLAST search
         */
        public function actionAutomaticCreate()
	{
//            print_r($_POST);
		$model=new Gen;
		if(isset($_POST))
		{
			$model->attributes=$_POST;
  //                      print_r($model);
			if($model->save())
				$this->redirect(array('view','id'=>$model->idtbl_gen));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gen']))
		{
			$model->attributes=$_POST['Gen'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idtbl_gen));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
            if(Yii::app()->request->getParam('export')) {
                $this->actionExport();
                Yii::app()->end();
            }
            $dataProvider=new CActiveDataProvider('Gen', array(
                'criteria'=>array(
                    'order'=>'idtbl_gen DESC',)
                ));
            $this->render('index',array(
                'dataProvider'=>$dataProvider,
                ));
	}

        public function actionExport() {
            $fp = fopen('php://temp', 'w');
            $headers = array(
                'codigoaccesion',
                'organismoorigen',
                'secuenciacompleta',
                'cds',
                'identificador',
            );
            $row = array();
            foreach($headers as $header) {
                $row[] = Gen::model()->getAttributeLabel($header);
            }
            fputcsv($fp,$row);
            $model=new Gen('search');
            $model->unsetAttributes();  // clear any default values
            foreach ($model->findAll() as $data) {
                $row = array();
                foreach($headers as $head) {
                    $row[] = CHtml::value($data,$head);                        
                }
                fputcsv($fp,$row);                    
            }
            rewind($fp);
            Yii::app()->user->setState('export',stream_get_contents($fp));
            fclose($fp);
	}
        
        public function actionExportFile() {
            Yii::app()->request->sendFile('genes.csv',Yii::app()->user->getState('export'));
            Yii::app()->user->clearState('export');
        }
        
        /**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Gen('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Gen']))
			$model->attributes=$_GET['Gen'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Gen the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Gen::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Gen $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gen-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
