<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\Dbank;

class DbankController extends \yii\web\Controller
{
  public function behaviors()
  {  //declare get and post method for url route 
  return [
       'verbs' => [
      'class' => VerbFilter::className(),
      'actions' => [
        'index'=>['get'],    
        'create-bank'=>['post','options'],
        'update-bank'=>['post','options'],
        'delete-bank'=>['post','options'],   
        'view-bank'=>['post','options'], 
        'get-bank'=>['post','options'],                        
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
      echo json_encode(array('status'=>"method not allowed"),JSON_PRETTY_PRINT);
      exit;          
    }         
    return true;  
  }   

    public function actionIndex() {         
	    $models = Dbank::getBankDetails();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
	    //convert json format    
    } 
    public function actionViewBank($id) { 
	    $models = Dbank::viewBankDetails($id);       
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
	    //convert json format    
    } 
    public function actionGetBank($id) { 
      $models = Dbank::viewDriverBank($id);       
      $this->setHeader(200);     
      echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
      //convert json format    
    }  
 

  	public function actionCreateBank() {         
	    $post = file_get_contents("php://input"); 
	    $params = json_decode($post, true); 
	    $model = new Dbank();  
	    $model->driver_id = $params[0]['driverId'];
	    $model->bank_name = $params['bankName'];  
	    $model->acc_no = $params['accountNo'];  
	    $model->branch = $params['branch'];  
	    $model->ifsc = $params['ifsc'];   
	    // $model->owner = $params['transOwner'];     
	    if ($model->save()) {      
	      $this->setHeader(200);
	      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	      $this->setHeader(400);
	     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
  	} 
  	public function actionUpdateBank($id) {
	    $post = file_get_contents("php://input");   
	    $params = json_decode($post, true);      
	   	$model = $this->findModel($id);    
	    $model->driver_id = $params[0]['driverId'];
	    $model->bank_name = $params['bankName'];  
	    $model->acc_no = $params['accountNo'];  
	    $model->branch = $params['branch'];  
	    $model->ifsc = $params['ifsc'];      
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
	  public function actionDeleteBank($id) {           
	    
	    $model = $this->findModel($id);   
	    $model->is_active = 0; 
	    if ($model->save()) {      
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
    if (($model = Dbank::findOne(['dbank_id' => $id])) !== null) {
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
