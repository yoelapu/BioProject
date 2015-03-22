<?php

class AreainteresController extends Controller
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($pGen,$pAccessCode)
	{
		$model=new Areainteres;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Areainteres']))
		{
			$model->attributes=$_POST['Areainteres'];
                        $model->idtbl_gen = $pGen;
			if($model->save())
				$this->redirect(array('view','id'=>$model->idtbl_areainteres));
		}

		$this->render('create',array(
			'model'=>$model,
                        'access_code'=> $pAccessCode,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Areainteres']))
		{
			$model->attributes=$_POST['Areainteres'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idtbl_areainteres));
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
	public function actionDelete($id)
	{
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
            $dataProvider=new CActiveDataProvider('Areainteres', array(
                'criteria'=>array(
                    'order'=>'idtbl_areainteres DESC',
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
                'secuenciainteres',
                'identificador',
            );
            $row = array();
            foreach($headers as $header) {
                $row[] = Areainteres::model()->getAttributeLabel($header);
            }
            fputcsv($fp,$row);
            $model=new Areainteres('search');
            foreach ($model->findAll() as $data) {
                $row = array();
                $model_keys = new Areainteres();
                foreach($headers as $head) {
                    if($head == 'idtbl_gen') {
                        $model_keys->idtbl_gen = CHtml::value($data,$head);
                        $row[] = $model_keys->getAccessCode();
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
            Yii::app()->request->sendFile('relevantareas.csv',Yii::app()->user->getState('export'));
            Yii::app()->user->clearState('export');
        }      
                
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Areainteres('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Areainteres']))
			$model->attributes=$_GET['Areainteres'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        /**
         * Filters by gene's id
         */
        public function actionFilter($pGene, $pAccessCode){
                $model = new Areainteres();
                
                if(isset($_GET['Areainteres']))
			$model->attributes=$_GET['Areainteres'];
		

		$this->render('filter',array(
			'model'=>$model,
                        'geneId' => $pGene,
                        'accessCode' => $pAccessCode,
		));
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Areainteres the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Areainteres::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Areainteres $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='areainteres-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
