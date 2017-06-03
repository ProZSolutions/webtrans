<?php

namespace app\controllers;

use Yii;
use app\models\Ldiesel;
use app\models\Ltrip;
use app\models\LdieselSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LdieselController implements the CRUD actions for Ldiesel model.
 */
class LdieselController extends Controller
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
     * Lists all Ldiesel models.
     * @return mixed
     */
    public function actionIndex()
    {   $model = new Ldiesel();        
        $searchModel = new LdieselSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         if ($model->load(Yii::$app->request->post()) && $model->save()) { 
            $total = $this->findSum($model->trip_id);
            $totDiesel = $this->findSumDiesel($model->trip_id);
            $modeltrip = $this->findLtrip($model->trip_id);
            $modeltrip->trip_diesel = $totDiesel;
            $modeltrip->diesel_amount = $total;
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
     * Displays a single Ldiesel model.
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
     * Creates a new Ldiesel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

       
        $model = new Ldiesel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ldiesel_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ldiesel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $total = $this->findSum($model->trip_id);
            $totDiesel = $this->findSumDiesel($model->trip_id);
            $modeltrip = $this->findLtrip($model->trip_id);
            $modeltrip->trip_diesel = $totDiesel;
            $modeltrip->diesel_amount = $total;
            $modeltrip->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ldiesel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {     
        
        $model = $this->findModel($id);
        $tripID = $model->trip_id;
        //$summodel = $this->findSumModel($id); 
         
        $model->delete();      
        
     
            $total = $this->findSum($tripID); 
                     
            $totDiesel = $this->findSumDiesel($tripID);
             
            $modeltrip = $this->findLtrip($tripID);

            $modeltrip->trip_diesel = $totDiesel;

            $modeltrip->diesel_amount = $total;
          
            if($modeltrip->save()){

            return $this->redirect(['index']);

            
            }
        
       
        return $this->redirect(['index']);
    }

    /**
     * Finds the Ldiesel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ldiesel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findSumModel($id)
    {
        if (($model = Ldiesel::find()->andWhere(['ldiesel_id' => $id])
            ->sum('diesel_amount')) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModel($id)
    {
        if (($model = Ldiesel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findSum($id)
    {  
        if (($model = Ldiesel::find()->andWhere(['trip_id' => $id])
            ->sum('diesel_amount')) !== null) {

            return $model;

            
        } else {

            return 0;
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
       protected function findSumDiesel($id)
    {
        if (($model = Ldiesel::find()->andWhere(['trip_id' => $id])
            ->sum('total_diesel')) !== null) {

            return $model;
            
        } else {
            return 0;
            //throw new NotFoundHttpException('The requested page does not exist.');
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
