<?php

class BLASTGeneController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated users to perform 'admin' and 'delete' actions
				'actions'=>array('configuration','viewConfiguration','create'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays the BLAST configuration for the current user
	 */
	public function actionViewConfiguration()
	{
		$this->render('/BLASTGene/viewConfiguration',array(
			'model'=>$this->loadConfiguration(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BLASTGene;
                $model->setscenario('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BLASTGene']))
		{
                    
			$model->attributes=$_POST['BLASTGene'];
                        $model->idtbl_user = 1;
                        
			if($model->save())
				$this->redirect(array('/BLASTGene/viewConfiguration','id'=>$model->idtbl_blastuserconfiguration));
		}

		$this->render('/BLASTGene/create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionConfiguration()
	{
		//$model=$this->loadModel($id);
                $model = new BLASTGene();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BLASTGene']))
		{
			$model->attributes=$_POST['BLASTGene'];
                        if($model->validate()){
                            
                            $configuration_id = $model->saveBLASTConfiguration(Yii::app()->user->id, $model);
                            
                            if($configuration_id > 0)
				$this->redirect(array('BLASTGene/view','id'=>$configuration_id));
                        }
		}

		$this->render('/BLASTGene/configuration',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BLASTGene the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BLASTGene::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        /**
         * Returns the model based on the username, (as the configuration is associated to each user)
         * @return BLASTGene the complete configuration
         * @throws CHttpException
         */
        public function loadConfiguration(){
            $model = BLASTGene::model()->getStoredConfiguration(Yii::app()->user->id);
            if($model===null)
                throw new CHttpException(404,'Stored configuration not found');
            return $model;
        }

	/**
	 * Performs the AJAX validation.
	 * @param BLASTGene $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blastgene-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
