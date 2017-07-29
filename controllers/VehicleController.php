<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\Vehicle;
use app\models\Expiry;

class VehicleController extends \yii\web\Controller
{
    public function behaviors()
  	{  //declare get and post method for url route 
    return [
         'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'index'=>['get'],    
          'create-vehicle'=>['post','options'],
          'update-vehicle'=>['post','options'],
          'delete-vehicle'=>['post','options'],  
          'view-vehicle'=>['post','options'],  
          'get-vehicle'=>['get','options'],   
          'trip-vehicle'=>['get','options'],                      
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
	    $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
	    $query ->from('vehicle') //table name          
	    	->select(['vehicle.vehicle_id as vehicleId','vehicle.vehicle_no AS vehicleNo','vehicle.type','transport.name','vehicle.engine_no AS engineNo', 'vehicle.chasis_no AS chasisNo','vendor.vendor_id as vendorId','vehicle.corporation','vendor.vendor_code as vendorCode'])
		    ->innerJoin('vendor', 'vendor.vendor_id = vehicle.vendor_id')
        ->innerJoin('transport', 'vendor.transport_id = transport.transport_id')
        ->orderBy('vehicle.vehicle_id DESC');  	             
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
  	} 
      public function actionTripVehicle() {         
      $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
      $query ->from('vehicle') //table name          
        ->select(['vehicle.vehicle_id as vehicleId','vehicle.vehicle_no AS vehicleNo'])
        ->andWhere(['ltrip'=>0]);                
      $command = $query->createCommand();
      $models = $command->queryAll();  
      $this->setHeader(200);     
      echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
    } 
      public function actionGetVehicle() {         
      $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
      $query ->from('vehicle') //table name          
        ->select(['vehicle.vehicle_id as vehicleId','vehicle.vehicle_no AS vehicleNo']);                
      $command = $query->createCommand();
      $models = $command->queryAll();  
      $this->setHeader(200);     
      echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
    }  


      public function actionViewVehicle($id) {         
      $query= new Query;//refer from use yii\db\Query.It is initialize start the prg
      $query ->from('vehicle') //table name          
        ->select(['vehicle.vehicle_id as vehicleId','vehicle.vehicle_no AS vehicleNo','vehicle.type','transport.name','vehicle.engine_no AS engineNo', 'vehicle.chasis_no AS chasisNo','vendor.vendor_id as vendorId','vehicle.corporation','vendor.vendor_code as vendorCode'])
        ->innerJoin('vendor', 'vendor.vendor_id = vehicle.vendor_id')
        ->innerJoin('transport', 'vendor.transport_id = transport.transport_id')
        ->where(['vehicle.vehicle_id'=>$id]);                
      $command = $query->createCommand();
      $models = $command->queryAll();  
      $this->setHeader(200);     
      echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
    //convert json format    
    } 
 
//create transport list
  public function actionCreateVehicle() {  
    //$transaction = Yii::$app->db->beginTransaction();   
       
    $post = file_get_contents("php://input");   
    $params = json_decode($post, true);       
    $model = new Vehicle();  //call Transport class from model  
    $expiry = new Expiry();          
    $model->vendor_id = $params['vendorId'];  
    $model->vehicle_no = $params['vehicleNo'];   
    $model->engine_no = $params['engineNo']; 
    $model->chasis_no = $params['chasisNo'];
    $model->corporation = $params['vendorCorp'];  
    $model->type = 0;  
    //$model->model = $params['model']; 
    //$model->user_id = $params['userId']; 
     
    // try  {
    // if ($model->save() && ($expiry->vehicle_id = $model->vehicle_id) $expiry->save()) {
    //     $transaction->commit();
    //     $this->setHeader(200);
    //     echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT); 
    // } else {
    //     $transaction->rollBack();
    //      $this->setHeader(400);
    //     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    // }
    // } catch (Exception $e) {
    // $transaction->rollBack();
    // }   


    if($model->save()) {     
      $expiry->vehicle_id = $model->vehicle_id; 
      $expiry->save();  
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  } 
  public function actionUpdateVehicle($id) {   
    $post = file_get_contents("php://input");    
    $params = json_decode($post, true);      
    $model = new Vehicle();
    $model = $this->findModel($id);  
    $exp = $this->findExpiry($id);
    $model->vendor_id = $params['vendorId'];  
    $model->vehicle_no = $params['vehicleNo'];   
    $model->engine_no = $params['engineNo']; 
    $model->chasis_no = $params['chasisNo'];
    $model->corporation = $params['corporation'];   
    $model->type = 0;      
    if ($model->save()) {  
    $exp->vehicle_id = $model->vehicle_id; 
       $exp->save();     
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  } 
  
  public function actionDeleteVehicle($id) {           
    $model = new Vehicle();
    $expiry = new Expiry();    
    $model = $this->findModel($id);       
    if ( $model->delete()) { 
     $this->findExp($id);      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }  

  protected function findModel($id) { 
    if (($model = Vehicle::findOne(['vehicle_id' => $id])) !== null) {
      return $model;
    }
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
      exit;
    }
  }
  protected function findExp($id) { 
    if (($model = Yii::$app->db->createCommand("DELETE FROM expiry WHERE vehicle_id = $id")->execute()) !== null) {
    return $model;     
    }
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
      exit;
    }
  }
  protected function findExpiry($id) {    
    if (($model = Expiry::findOne($id)) !== null) {
      return $model;
    }
    else {
     $expiry = new Expiry(); 
     return $expiry;
    }
  }
  //used to set header
  private function setHeader($status) {    
    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    $content_type = "application/json";  
    header($status_header);
   // header('Content-type: ' . $content_type);

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
