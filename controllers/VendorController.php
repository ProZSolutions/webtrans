<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\Vendor;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class VendorController extends \yii\web\Controller
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
          'index'=>['get'],    
          'create-vendor'=>['post','options'],
          'update-vendor'=>['post','options'],
          'delete-vendor'=>['post','options'],     
          'get-vendor'=>['post','options'],                     
        ],        
      ],
      
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
    $query= new Query;
    $query ->from('vendor')         
    	->select(['vendor.vendor_id AS vendorId','vendor.transport_id AS transportId','transport.name AS transportName','vendor.vendor_code AS vendorCode', 'vendor.vendor_corp as vendorCorp'])
	    ->innerJoin('transport', 'transport.transport_id = vendor.transport_id')
      ->where(['vendor.is_active' => 1])
      ->orderBy('vendor.vendor_id DESC'); 
    $command = $query->createCommand();
    $models = $command->queryAll();  
    $this->setHeader(200);     
    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES);   
  } 

   public function actionGetVendor($id) {         
    $query= new Query;
    $query ->from('vendor')         
      ->select(['vendor.vendor_id AS vendorId','vendor.transport_id AS transportId','transport.name AS transportName','vendor.vendor_code AS vendorCode', 'vendor.vendor_corp as vendorCorp'])
      ->innerJoin('transport', 'transport.transport_id = vendor.transport_id')
      ->where(['vendor.is_active' => 1])
      ->where(['vendor.vendor_id' => $id]);
    $command = $query->createCommand();
    $models = $command->queryAll();  
    $this->setHeader(200);     
    echo json_encode($models,JSON_UNESCAPED_SLASHES);   
  }  

  public function actionCreateVendor() {     
    $post = file_get_contents("php://input");    
    $params = json_decode($post, true);    
    $model = new Vendor();    
    $model->transport_id = $params['transportId'];  
    $model->vendor_code = $params['vendorCode'];     
    $model->vendor_corp = $params['vendorCorp'];  
    $model->user_id = 001; 
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_UNESCAPED_SLASHES);
    }     
  } 
  
  public function actionUpdateVendor($id) {   
    $post = file_get_contents("php://input");    
    $params = json_decode($post, true);    
    $model = new Vendor(); 
    $model = $this->findModel($id);    
    $model->transport_id = $params['transportId'];  
    $model->vendor_code = $params['vendorCode'];     
    $model->vendor_corp = $params['vendorCorp'];  
    $model->user_id = 001;     
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  } 
  
  public function actionDeleteVendor($id) {           
    $model = new Vendor();
    $model = $this->findModel($id);   
    $model->is_active=0;     
    if ($model->save()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }

  
  protected function findModel($category_ID) { 
    if (($model = Vendor::findOne(['vendor_id' => $category_ID])) !== null) {
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
     
    header($status_header);
      
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
