<?php

namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\BillList;
use app\models\Expiry;

class BillController extends \yii\web\Controller
{
  public function behaviors()
	{  //declare get and post method for url route 
    return [
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'index'=>['get'],    
          'create-bill'=>['post','options'],
          'update-bill'=>['post','options'],
          'delete-bill'=>['post','options'], 
          'view-bill'=>['post','options'],                        
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
    $models = BillList::getBillList();
    $this->setHeader(200);     
    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES);    
	}
  public function actionViewBill($id) {         
    $models = BillList::viewBill($id);
    $this->setHeader(200);     
    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES);    
  }
  public function actionCreateBill() {       
    //$params = Yii::$app->getRequest()->getBodyParams(); 
    $post = file_get_contents("php://input");
    //decode json post input as php array:
    $params = json_decode($post, true); 
    
    $model = new BillList();      
    $model->vehicle_id = $params['vehicleId'];  
    $model->type = $params['type'];   
    //$expModel = new Expiry();
    $model->from = date('Y-m-d', strtotime($params['fromDate']));  
    $model->to = date('Y-m-d', strtotime($params['toDate'])); 
    $model->amount = $params['amount'];
    $model->paid_date = date('Y-m-d', strtotime($params['paidDate']));
    $model->num = $params['billNo'];  
    //$model->user_id = $params['userId']; 
    if($model->save()){
      $expEntry = $this->expiryEntry($model->type, $model->vehicle_id, $model->bill_id, $model->to);
      $expEntry->save(); 
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors),'exp_data'=>array_filter($expiry->errors)),JSON_PRETTY_PRINT);
    }     
  }
  public function actionUpdateBill($id) {   
    $post = file_get_contents("php://input");
    //decode json post input as php array:
    $params = json_decode($post, true);      
    $model = new BillList();
    $model = $this->findModel($id);         
    $model->vehicle_id = $params['vehicleId'];  
    $model->type = $params['type'];
    $model->from = date('Y-m-d', strtotime($params['fromDate'])); 
    $model->to = date('Y-m-d', strtotime($params['toDate']));  
    $model->amount = $params['amount'];
    $model->paid_date = date('Y-m-d', strtotime($params['paidDate'])); 
    $model->num = $params['billNo'];    
    if ($model->save()) {    
      $expEntry = $this->expiryEntry($model->type, $model->vehicle_id, $model->bill_id, $model->to);
      $expEntry->save();  
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }  
  public function actionDeleteBill($id) {           
    $model = new BillList();
    $model = $this->findModel($id); 
    $data = $this->expiryDelete($model->type, $model->vehicle_id); 
    $data->save();
    if($model->delete()) {      
      $this->setHeader(200);
      echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
    } 
    else {
      $this->setHeader(400);
     echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
    }     
  }
  
  protected function findModel($id) { 
    if (($model = BillList::findOne(['bill_id' => $id])) !== null) {
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
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
      exit;
    }
  }
  protected function expiryEntry($type, $id, $billId, $to) { 
    $expModel = $this->findExpiry($id); 
    if($type == 'fc'){
      $expModel->fc_id = $billId;
      $expModel->fc_date = $to;    
    } 
    elseif($type == 'insurance'){       
      $expModel->insurance_id = $billId;
      $expModel->insurance_date = $to;    
    } 
    elseif($type == 'national'){     
      $expModel->national_id = $billId;
      $expModel->national_date = $to;    
    } 
    elseif($type == 'permit'){       
      $expModel->permit_id = $billId;
      $expModel->permit_date = $to;    
    } 
    elseif($type == 'explosive'){     
      $expModel->explosive_id = $billId;
      $expModel->explosive_date = $to;    
    } 
    elseif($type == 'yearly'){
      $expModel->yearly_id = $billId;
      $expModel->yearly_date = $to;    
    } 
    elseif($type == 'halfyearly'){     
      $expModel->halfyearly_id = $billId;
      $expModel->halfyearly_date = $to;    
    } 
    elseif($type == 'hydro'){      
      $expModel->hydro_id = $billId;
      $expModel->hydro_date = $to;       
    } 
    elseif($type == 'cll'){     
      $expModel->cll_id = $billId;
      $expModel->cll_date = $to;    
    } 
    elseif($type == 'pli'){    
      $expModel->pli_id = $billId;
      $expModel->pli_date = $to;    
    } 
    elseif($type == 'tax'){      
      $expModel->tax_id = $billId;
      $expModel->tax_date = $to;    
    } 
    return $expModel;   
  }
    protected function expiryDelete($type, $id) { 
    $expModel = $this->findExpiry($id); 
    if($type == 'fc'){
      $expModel->fc_id = Null;
      $expModel->fc_date = Null;    
    } 
    elseif($type == 'insurance'){       
      $expModel->insurance_id = Null;
      $expModel->insurance_date = Null;    
    } 
    elseif($type == 'national'){     
      $expModel->national_id = Null;
      $expModel->national_date = Null;    
    } 
    elseif($type == 'permit'){       
      $expModel->permit_id = Null;
      $expModel->permit_date = Null;    
    } 
    elseif($type == 'explosive'){     
      $expModel->explosive_id = Null;
      $expModel->explosive_date = Null;    
    } 
    elseif($type == 'yearly'){
      $expModel->yearly_id = Null;
      $expModel->yearly_date = Null;    
    } 
    elseif($type == 'halfyearly'){     
      $expModel->halfyearly_id = Null;
      $expModel->halfyearly_date = Null;    
    } 
    elseif($type == 'hydro'){      
      $expModel->hydro_id = Null;
      $expModel->hydro_date = Null;       
    } 
    elseif($type == 'cll'){     
      $expModel->cll_id = Null;
      $expModel->cll_date = Null;    
    } 
    elseif($type == 'pli'){    
      $expModel->pli_id = Null;
      $expModel->pli_date = Null;    
    } 
    elseif($type == 'tax'){      
      $expModel->tax_id = Null;
      $expModel->tax_date = Null;    
    } 
    return $expModel;   
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

