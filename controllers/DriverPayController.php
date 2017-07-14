<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\Dpayment;
use app\modules\trip\models\Ltrip;

class DriverPayController extends \yii\web\Controller
{
    public function behaviors()
  	{  //declare get and post method for url route 
    return [
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'index'=>['get'],    
          'create-payment'=>['post','options'],
          'update-payment'=>['post'],
          'delete-payment'=>['post'], 
          'view-payment'=>['get','options'], 
          'get-payment'=>['get','options'],                         
        ],        
      ]
    ];
  	}
  
  	public function beforeAction($event)
  	{
	    $action = $event->id;   
	    if (isset($this->actions[$action])) {
	      $verbs = $this->actions[$action];
	    } 
	    elseif (isset($this->actions['*'])) {
	      $verbs = $this->actions['*'];
	    } 
	    else {
	      return $event->isValid;
	    }
	    $verb = Yii::$app->getRequest()->getMethod(); 
	    $allowed = array_map('strtoupper', $verbs);    
	    if (!in_array($verb, $allowed)) {          
	      $this->setHeader(400);
	      echo json_encode(array('status'=>"method not allowed"),JSON_PRETTY_PRINT);
	      exit;          
	    }         
	    return true;  
  	}   
  
  	public function actionIndex() {         
	    $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
	    $query ->from('dpayment AS dp') //table name          
	    	->select(['dp.payment_id as paymentId','dp.driver_id AS driverId','driver.name','dp.mode','dp.amount', 'dp.dbank_id AS bankId','dbank.acc_no as accNo','dp.date','dp.for', 'dp.trip_id as tripId', 'ltrip.trip_no as tripNo'])
		    ->innerJoin('driver', 'driver.driver_id = dp.driver_id')
        ->innerJoin('dbank', 'dbank.dbank_id = dp.dbank_id')
        ->innerJoin('ltrip', 'ltrip.trip_id = dp.trip_id');		              
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES);     
  	}  

      public function actionViewPayment($id) { 
       
      $query= new Query;        
      $query ->from('dpayment AS dp') //table name          
        ->select(['dp.payment_id as paymentId','dp.driver_id AS driverId','driver.name','dp.mode','dp.amount', 'dp.dbank_id AS bankId','dbank.acc_no as accNo','dp.date','dp.for', 'dp.trip_id as tripId', 'ltrip.trip_no as tripNo'])
        ->innerJoin('driver', 'driver.driver_id = dp.driver_id')
        ->leftJoin('dbank', 'dbank.dbank_id = dp.dbank_id')
        ->innerJoin('ltrip', 'ltrip.trip_id = dp.trip_id') 
        ->andWhere(['dp.trip_id'=> $id]);            
      $command = $query->createCommand();
      $models = $command->queryAll();  
      $this->setHeader(200);     
      echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
    }

       public function actionGetPayment($id) { 
      $query= new Query;        
      $query ->from('dpayment AS dp') //table name          
        ->select(['dp.payment_id as paymentId','dp.driver_id AS driverId','driver.name','dp.mode','dp.amount', 'dp.dbank_id AS bankId','dbank.acc_no as accNo','dp.date','dp.for', 'dp.trip_id as tripId', 'ltrip.trip_no as tripNo'])
        ->innerJoin('driver', 'driver.driver_id = dp.driver_id')
        ->leftJoin('dbank', 'dbank.dbank_id = dp.dbank_id')
        ->innerJoin('ltrip', 'ltrip.trip_id = dp.trip_id') 
        ->andWhere(['dp.payment_id'=> $id]);            
      $command = $query->createCommand();
      $models = $command->queryAll();  
      $this->setHeader(200);     
      echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
    }     
    public function actionCreatePayment() {       
   
    $post = file_get_contents("php://input");
    $params = json_decode($post, true);       
    $model = new Dpayment();  
    $model->driver_id = $params['driverId'];  
    $model->mode = $params['mode'];   
    $model->amount = $params['amount']; 
    if($model->mode == 'Cash') {
    	$model->dbank_id = $params['bankId'];  
	}
    $model->date = $params['date']; 
    $model->for = $params['for']; 
    $model->trip_id = $params['tripId'];    
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }
  public function actionUpdatePayment($id) {   
    $post = file_get_contents("php://input");
    //decode json post input as php array:
    $params = json_decode($post, true); 
      $model = new Ltrip();    
      $model = $this->findModelTrip($params['tripId']); 
   
      $model->trip_advance = $params['amount'];    
      if ($model->save()) {
          $pay = $this->findModel($id);
          $pay->driver_id = $params['driverId'];  
          $pay->mode = $params['mode'];   
          $pay->amount = $params['amount']; 
          if($pay->mode == 'account') {
            $pay->dbank_id = $params['bankId'];  
          }
          $pay->date = date('Y-m-d', strtotime($params['date']));
          $pay->for = 'adv'; 
          $pay->trip_id = $params['tripId']; 
          $pay->save();

            $total = $this->sumOfAdvance($model->trip_id); 
            $modeltrip = $this->findModelTrip($model->trip_id);
            $modeltrip->trip_advance = $total;           
            $modeltrip->save();         

          $modelExp = $this->findModelTrip($model->trip_id); 
          $modelExp->totalexpense =  $this->findSumOfExp($model->trip_id);
          $modelExp->save();    
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  } 
  
  public function actionDeletePayment($id) {    
    $model = new Dpayment();
    $model = $this->findModel($id);         
    if ($model->delete()) { 
          
            $total = $this->sumOfAdvance($model->trip_id); 
            $modeltrip = $this->findModelTrip($model->trip_id);
            $modeltrip->trip_advance = $total;           
            $modeltrip->save();

          $modelExp = $this->findModelTrip($model->trip_id); 
          $modelExp->totalexpense =  $this->findSumOfExp($model->trip_id);
          $modelExp->save();  

      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }

  protected function sumOfAdvance($id) { 
    if (($model = Dpayment::find()->andWhere(['trip_id' => $id, 'for'=>'adv'])
      ->sum('amount')) !== null) {
      return $model;
    }
    else {
      return 0;
      }
   }
      protected function findSumOfExp($id)
    {  
        if (($model = Ltrip::find()->andWhere(['trip_id' => $id])
            ->sum('diesel_amount + trip_advance + trip_expenses')) !== null) {
            return $model;            
        } else {
            return 0;
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
  protected function findModel($id) { 
    if (($model = Dpayment::findOne(['payment_id' => $id])) !== null) {
      return $model;
    }
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
      exit;
    }
  }
   protected function findModelTrip($id) { 

   if (($model = Ltrip::findOne(['trip_id' => $id])) !== null) {
      return $model;
    }
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message1'=>'Bad request')),JSON_PRETTY_PRINT);
      exit;
    }
  }
  //used to set header
  private function setHeader($status) {    
    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    $content_type = "application/json";  
    header($status_header);
    header('Content-type: ' . $content_type);
    header('X-Powered-By: ' . "ProZ Solutions");
  }
  //get satus code
  private function _getStatusCodeMessage($status)
  {
    $codes = Array(
      200 => 'OK.',
      201 =>'A resource was successfully created in response to a POST request. The Location header contains the URL pointing to the newly created resource.',
      204 =>  'The request was handled successfully and the response contains no content.', 
      304 =>  'The resource was not modified.',
      400 =>  'Bad request.',
      401 =>  'Authentication failed.',
      403 =>  'The authenticated user is not allowed to access the specified API endpoint.',
      404 =>  'The resource does not exist.',
      405 =>  'Method not allowed.',
      415 =>  'Unsupported media type.',
      422 =>  'Data validation failed.',
      429 =>  'Too many requests.',
      500 =>  'Internal server error.',     
    );
  return (isset($codes[$status])) ? $codes[$status] : '';
  }


}
