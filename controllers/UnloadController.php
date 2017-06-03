<?php

namespace app\controllers;
use Yii;
use app\models\Ltrip;
use app\models\Ldiesel;
use app\models\Lexpense;
use app\models\Lpayment;
use app\models\LtripSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;


class UnloadController extends \yii\web\Controller
{
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
     * Lists all Ltrip models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LtripSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ltrip model.
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
     * Creates a new Ltrip model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        
        $model = new Ltrip();
        if(Yii::$app->request->post() != null){
        $data = Yii::$app->request->post();   
       
        $model = $this->findModel($data['Ltrip']['trip_id']);
        $model->load($data); 
        $model->trip_status= 2;
        $model->save();	
         
            return $this->redirect(['ltrip/index']);
        }
         else {
         	
            return $this->render('create', [
                'model' => $model,
               	 
            ]);
        }
    }

    /**
     * Updates an existing Ltrip model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->trip_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionGetLoadedVehicle($vehicleId){
    	$VehicleDetails = Ltrip::find()->andWhere(['trip_id'=>$vehicleId])->one();
    	echo Json::encode($VehicleDetails);
    }


    /**
     * Deletes an existing Ltrip model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ltrip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ltrip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
         if (($model = Ltrip::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
          
    }

}
