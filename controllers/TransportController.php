<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\Transport;

class TransportController extends \yii\web\Controller
{
    
  public function behaviors() {  //declare get and post method for url route 
    return [
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'index'=>['get'],    
          'create-transport'=>['post','options'],
          'update-transport'=>['post','options'],
          'delete-transport'=>['post','options'], 
          'view-transport'=>['get','options'],                        
        ],        
      ]
    ];
  }
  
  //access the action (for example actionUplaodCategoryList)
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
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'method not allowed'),JSON_PRETTY_PRINT));
      exit;          
    }         
    return true;  
  }   
  
  public function actionIndex() {         
    $query= new Query;
    $query ->from('transport') //table name     
    ->select("transport_id as transportId,name,owner");           
    $command = $query->createCommand();
    $models = $command->queryAll();  
    $this->setHeader(200);     
    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
  } 

  public function actionViewTransport($id) {         
    $query= new Query;
    $query ->from('transport') //table name     
    ->select("transport_id as transportId,name,owner")
    ->where(['transport_id'=>$id]);           
    $command = $query->createCommand();
    $models = $command->queryAll();  
    $this->setHeader(200);     
    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
  } 
  public function actionCreateTransport() {     
    $post = file_get_contents("php://input");   
    $params = json_decode($post, true);   
    $model = new Transport();  //call Transport class from model     
    $model->name = $params['name'];  
    $model->owner = $params['owner'];     
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  } 

  public function actionUpdateTransport($id) {   
    $post = file_get_contents("php://input");   
    $params = json_decode($post, true);      
    $model = new Transport();
    $model = $this->findModel($id);    
    $model->name = $params['name'];  
    $model->owner = $params['owner'];      
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }  
  public function actionDeleteTransport($id) {           
    $model = new Transport();
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
  protected function findModel($id) { 
    if (($model = Transport::findOne(['transport_id' => $id])) !== null) {
      return $model;
    }
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
      exit;
    }
  } 
  private function setHeader($status) {    
    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    $content_type = "application/json";  
    header($status_header);
    header('Content-type: ' . $content_type);
    header('X-Powered-By: ' . "ProZ Solutions");
  }  
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
