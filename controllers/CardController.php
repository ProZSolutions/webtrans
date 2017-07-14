<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\Card;

class CardController extends \yii\web\Controller
{
    public function behaviors()
  	{  //declare get and post method for url route 
    return [
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'index'=>['get'],    
          'create-card'=>['post','options'],
          'update-card'=>['post','options'],
          'delete-card'=>['post','options'], 
          'view-card'=>['post','options'],                         
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
	    $query ->from('card') //table name          
	    	->select(['card.card_id as cardId','card.vehicle_id as vehicleId','card.card_no AS cardNo','card.corp AS corporation', 'vehicle.vehicle_no AS vehicleNo','card.cust_id AS custId'])
		    ->innerJoin('vehicle', 'vehicle.vehicle_id = card.vehicle_id')
		    ->andWhere(['is_active'=> 1]);            
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
  	}  

      public function actionViewCard($id) {         
      $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
      $query ->from('card') //table name          
        ->select(['card.card_id as cardId','card.vehicle_id as vehicleId','card.card_no AS cardNo','card.corp AS corporation', 'vehicle.vehicle_no AS vehicleNo','card.cust_id AS custId'])
        ->innerJoin('vehicle', 'vehicle.vehicle_id = card.vehicle_id')
        ->andWhere(['is_active'=> 1])
        ->andWhere(['card_id'=> $id]);            
      $command = $query->createCommand();
      $models = $command->queryAll();  
      $this->setHeader(200);     
      echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
    }    
    public function actionCreateCard() {       
    //$params = Yii::$app->getRequest()->getBodyParams(); 
    $post = file_get_contents("php://input");

   //decode json post input as php array:
    $params = json_decode($post, true);
       
    $model = new Card();  //call Transport class from model     
    $model->card_no = $params['cardNo'];  
    $model->corp = $params['corporation'];   
    $model->vehicle_id = $params['vehicleId'];  
    $model->cust_id = $params['custId'];  
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
  public function actionUpdateCard($id) {   
    $post = file_get_contents("php://input");
    //decode json post input as php array:
    $params = json_decode($post, true);      
    $model = new Card();
    $model = $this->findModel($id);         
    $model->card_no = $params['cardNo'];  
    $model->corp = $params['corporation'];   
    $model->vehicle_id = $params['vehicleId'];  
    $model->cust_id = $params['custId'];     
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  } 
  
  public function actionDeleteCard($id) {           
    $model = new Card();
    $model = $this->findModel($id);   
    $model->is_active='0';     
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }
   
  protected function findModel($id) { 
    if (($model = Card::findOne(['card_id' => $id])) !== null) {
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
