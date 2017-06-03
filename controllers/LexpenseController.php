<?php

namespace app\controllers;

use Yii;
use app\models\Lexpense;
use app\models\Ltrip;
use app\models\LexpenseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LexpenseController implements the CRUD actions for Lexpense model.
 */
class LexpenseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Lexpense models.
     * @return mixed
     */
    public function actionIndex()
    {   $model = new Lexpense();
        $searchModel = new LexpenseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
         if ($model->load(Yii::$app->request->post()) && $model->save()) { 
            $total = $this->findSum($model->trip_id);

            $modeltrip = $this->findLtrip($model->trip_id);
            $modeltrip->trip_expenses = $total;           
            $modeltrip->save();
            return $this->redirect(['index']);             
        } else {
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
        }
    }

    /**
     * Displays a single Lexpense model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Lexpense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         $model = new Lexpense();
            $searchModel = new LexpenseSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
         if ($model->load(Yii::$app->request->post()) && $model->save()) { 
            $total = $this->findSum($model->trip_id);

            $modeltrip = $this->findLtrip($model->trip_id);
            $modeltrip->trip_expenses = $total;           
            $modeltrip->save();
            return $this->redirect(['create']);             
        } else {
        return $this->render('create', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
        }
    }

    /**
     * Updates an existing Lexpense model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $total = $this->findSum($model->trip_id);
            $modeltrip = $this->findLtrip($model->trip_id);
            $modeltrip->trip_expenses = $total;           
            $modeltrip->save();
            return $this->redirect(['create']);   
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lexpense model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   
        $model = $this->findModel($id);
        $tripID = $model->trip_id;        
         
        $model->delete();      
        
     
            $total = $this->findSum($tripID); 
                     
           
             
            $modeltrip = $this->findLtrip($tripID);

            $modeltrip->trip_expenses = $total;

          
            if($modeltrip->save()){

            return $this->redirect(['create']);

            
            }       
       
      

        
    }

    /**
     * Finds the Lexpense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lexpense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lexpense::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
        protected function findSum($id)
    {
        if (($model = Lexpense::find()->andWhere(['trip_id' => $id])
            ->sum('load_wages+phone+spare +cliner +driver+toll+rto+other')) !== null) {
            return $model;
                    
        } else {
            return 0;
        }
    }
    protected function findLtrip($id)
    {
         if (($model = Ltrip::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
