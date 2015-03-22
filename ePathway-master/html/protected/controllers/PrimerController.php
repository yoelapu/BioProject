<?php

class PrimerController extends Controller
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
	public function accessRules() {
		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array(),
//				'users'=>array('*'),
//			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update', 'admin', 'filter','exportFile'),
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
            $model = $this->loadModel($id);
            $model->setPrimerPairSequence($model);
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id, $pAccessCode) {
                $model=new Primer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Primer']))
		{
			$model->attributes=$_POST['Primer'];
                        $model->idtbl_gen = $id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->idtbl_primer));
		}
                
                $primer_status = $model->retrievePrimerStatusList();
                $model->PrimerStatus = $primer_status;

		$this->render('create',array(
			'model'=>$model,
                        'primer_status'=>$primer_status,
                        'access_code'=> $pAccessCode
		));
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

		if(isset($_POST['Primer']))
		{
			$model->attributes=$_POST['Primer'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idtbl_primer));
		}
                
                $model->PrimerStatus = $model->retrievePrimerStatusList();
                
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
             $dataProvider=new CActiveDataProvider('Primer', array(
                    'criteria'=>array(
                        'order'=>'idtbl_primer DESC',
                        )
                ));
            $this->render('index',array(
                'dataProvider'=>$dataProvider,
		));
	}

        
        public function actionExport() {
            $fp = fopen('php://temp', 'w');
            $headers = array(
                'idtbl_gen',
                'primerrinicio',
                'primerrlongitud',
                'primerfinicio',
                'primerflongitud',
                'observaciones',
                'idtbl_estadoprimer',
            );
            $row = array();
            foreach($headers as $header) {
                $row[] = Primer::model()->getAttributeLabel($header);
            }
            fputcsv($fp,$row);
            $model=new Primer('search');
            foreach ($model->findAll() as $data) {
                $row = array();
                $model_keys = new Primer();
                foreach($headers as $head) {
                    if($head == 'idtbl_gen') {
                        $model_keys->idtbl_gen = CHtml::value($data,$head);
                        $row[] = $model_keys->getAccessCode();
                    }
                    else if ($head == 'idtbl_estadoprimer') {
                        $model_keys->idtbl_estadoprimer = CHtml::value($data,$head);
                        $row[] = $model_keys->getPrimerStatusText();
                    }
                    else
                        $row[] = CHtml::value($data,$head);
                }
                fputcsv($fp,$row);        
            }
            rewind($fp);
            Yii::app()->user->setState('export',stream_get_contents($fp));
            fclose($fp);
	}
        
        public function actionExportFile() {
            Yii::app()->request->sendFile('primers.csv',Yii::app()->user->getState('export'));
            Yii::app()->user->clearState('export');
        }
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Primer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Primer']))
			$model->attributes=$_GET['Primer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        
        public function actionFilter($pGeneId, $pAccessCode){
            	$model=new Primer();
		//$model->unsetAttributes();  // clear any default values
                if(isset($_GET['Primer']))
			$model->attributes=$_GET['Primer'];
		

		$this->render('filter',array(
			'model'=>$model,
                        'geneId' => $pGeneId,
                        'accessCode' => $pAccessCode,
		));
        }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Primer the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Primer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Primer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='primer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
