<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\Cdeposit;

class CardDepositController extends \yii\web\Controller
{
    public function behaviors()
  	{  //declare get and post method for url route 
    return [
         'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'index'=>['get'],    
          'create-deposit'=>['post','options'],
          'update-deposit'=>['post','options'],
          'delete-deposit'=>['post','options'],      
          'view-deposit'=>['post','options'],                    
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
	      echo json_encode(array('status'=>"error",'data'=>array('message'=>'method not allowed')),JSON_PRETTY_PRINT);
	      exit;          
	    }         
	    return true;  
  	}   
  	public function actionIndex() {         
	    $query= new Query;
	    $query ->from('cdeposit') //table name          
	    	->select(['cdeposit.vehicle_id as vehicleId','cdeposit.tbank_id as bankId','tbank.acc_no AS accountNo','cdeposit.card_id as cardId','cdeposit.cdeposit_id as depositId','vehicle.vehicle_no as vehicleNo','card.card_no AS cardNo','cdeposit.amount',"DATE_FORMAT(cdeposit.date, '%d-%m-%Y') as date",'cdeposit.deposit_by as depositBy'])
		    ->innerJoin('vehicle', 'vehicle.vehicle_id = cdeposit.vehicle_id')
		    ->innerJoin('card', 'card.card_id = cdeposit.card_id')
		    ->innerJoin('tbank', 'tbank.tbank_id = cdeposit.tbank_id');		              
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
      //convert json format    
  	}  
      public function actionViewDeposit($id) {         
      $query= new Query;
      $query ->from('cdeposit') //table name          
        ->select(['cdeposit.vehicle_id as vehicleId','cdeposit.tbank_id as bankId','tbank.acc_no AS accountNo','cdeposit.card_id as cardId','cdeposit.cdeposit_id as depositId','vehicle.vehicle_no as vehicleNo','card.card_no AS cardNo','cdeposit.amount',"DATE_FORMAT(cdeposit.date, '%d-%m-%Y') as date",'cdeposit.deposit_by as depositBy'])
        ->innerJoin('vehicle', 'vehicle.vehicle_id = cdeposit.vehicle_id')
        ->innerJoin('card', 'card.card_id = cdeposit.card_id')
        ->innerJoin('tbank', 'tbank.tbank_id = cdeposit.tbank_id')
        ->where(['cdeposit.cdeposit_id'=>$id]);                 
      $command = $query->createCommand();
      $models = $command->queryAll();  
      $this->setHeader(200);     
      echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
      //convert json format    
    }   
 

  public function actionCreateDeposit() {       
    //$params = Yii::$app->getRequest()->getBodyParams(); 
    $post = file_get_contents("php://input");  
    $params = json_decode($post, true);       
    $model = new Cdeposit();  //call Transport class from model     
    $model->card_id = $params['cardId'];  
    $model->vehicle_id = $params['vehicleId'];
    $model->tbank_id = $params['bankId'];   
    $model->amount = $params['amount'];  
    $model->deposit_by = $params['depositBy'];  
    $model->date = date('Y-m-d', strtotime($params['date']));
    //$model->user_id = $params['userId']; 
   
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  } 
  //update category list using(category id)
  public function actionUpdateDeposit($id) {   
    $post = file_get_contents("php://input");
    //decode json post input as php array:
    $params = json_decode($post, true);      
    $model = new Cdeposit();
    $model = $this->findModel($id);         
    $model->card_id = $params['cardId'];  
    $model->vehicle_id = $params['vehicleId'];
    $model->tbank_id = $params['bankId'];   
    $model->amount = $params['amount'];  
    $model->deposit_by = $params['depositBy'];  
    $model->date = date('Y-m-d', strtotime($params['date']));    
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  } 
  //delete category list using category id
  public function actionDeleteDeposit($id) {           
   
    $model = $this->findModel($id);   
       
    if ($model->delete()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }
  
  //find particular data for delete and update process
  protected function findModel($id) { 
    if (($model = Cdeposit::findOne(['cdeposit_id' => $id])) !== null) {
      return $model;
    }
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
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
