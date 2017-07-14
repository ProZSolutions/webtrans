<?php

namespace app\modules\tyre\controllers;

class LpgTyreController extends \yii\web\Controller
{
    	public function behaviors() {  
	    return [
	        'verbs' => [
	        'class' => VerbFilter::className(),
	        'actions' => [
	          	'index'=>['get'],    
	          	'create-lpgtyre'=>['post'],
	          	'update-lpgtyre'=>['post'],
	          	'delete-lpgtyre'=>['post'],
	          	'view-lpgtyre'=>['post'],                                  
	        ],        
	      	]
	    ];
  	}  
  	public function beforeAction($event) {
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
	    $query ->from('lpg_tyre_details AS lt') //table name          
	    	->select(['vehicle.vehicle_no as vehicleNo','lt.bill_no as billNo','lt.company','lt.price','lt.starting_KM as startingKM','lt.type','lt.total_KM as totalKM','lt.purchase_date as purchaseDate','lt.status','lt.tyre_no as tyreNo'])
	    	->innerJoin('vehicle', 'vehicle.vehicle_id = lt.vehicle_id');    
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	      
  	}  

  	public function actionViewExpense($id) {         
	    $query= new Query;
	    $query ->from('lpg_tyre_details AS lt') //table name          
	    	->select(['vehicle.vehicle_no as vehicleNo','lt.bill_no as billNo','lt.company','lt.price','lt.starting_KM as startingKM','lt.type','lt.total_KM as totalKM','lt.purchase_date as purchaseDate','lt.status','lt.tyre_no as tyreNo'])
	    	->innerJoin('vehicle', 'vehicle.vehicle_id = lt.vehicle_id');    
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES);      
  	}  

  	public function actionCreateLpgtyreDetails() {     
	    $post = file_get_contents("php://input");	   
	    $params = json_decode($post, true);	       
	    $model = new LpgTyreDetails();  //call Transport class from model 
	    $model->vehicle_id = $params['vehicleId'];     
	    $model->bill_no = $params['billNo'];  
	    $model->company = $params['company'];
	    $model->price = $params['price'];    
	    $model->starting_KM = $params['startingKM'];  
	    $model->type = $params['type']; 	     
	    $model->total_KM = $params['totalKM']; 
	    $model->purchase_date = $params['purchaseDate']; 
	    $model->status = $params['status']; 
	    $model->tyre_no = $params['tyreNo'];
	    //$model->other = $params['other'];  	    
	    if ($model->save()) {   
	    	// $total = $this->findSum($model->trip_id);
      //   	$modeltrip = $this->findLtrip($model->trip_id); 
      //   	$modeltrip->trip_expenses = $total;           
      //   	$modeltrip->save();   
	      	$this->setHeader(200);
	      	echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	      	$this->setHeader(400);
	     	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
 	}	
	
  	public function actionUpdateLpgtyreDetails($id) {   
	    $post = file_get_contents("php://input");	    
	    $params = json_decode($post, true); 	   
	    $model = $this->findModel($id);    
	    $model = new LpgTyreDetails();  //call Transport class from model 
	    $model->vehicle_id = $params['vehicleId'];     
	    $model->bill_no = $params['billNo'];  
	    $model->company = $params['company'];
	    $model->price = $params['price'];    
	    $model->starting_KM = $params['startingKM'];  
	    $model->type = $params['type']; 	     
	    $model->total_KM = $params['totalKM']; 
	    $model->purchase_date = $params['purchaseDate']; 
	    $model->status = $params['status']; 
	    $model->tyre_no = $params['tyreNo'];     
	    if ($model->save()) {  
	    	// $total = $this->findSum($model->trip_id);
      //   	$modeltrip = $this->findLtrip($model->trip_id); 
      //   	$modeltrip->trip_expenses = $total;           
      //   	$modeltrip->save();     
	    	$this->setHeader(200);
	      	echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	    	$this->setHeader(400);
	     	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
  	} 
  
 	public function actionDeleteLpgtyreDetails($id) 
 	{           
	    $model = new Ltrip();
	    $model = $this->findModel($id);      
	    if ($model->delete()) {  
	    	$total = $this->findSum($model->trip_id);
        	$modeltrip = $this->findLtrip($model->trip_id); 
        	$modeltrip->trip_expenses = $total;           
        	$modeltrip->save();    
	      		$this->setHeader(200);
	      		echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	      	$this->setHeader(400);
	     	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
 	}  
  	protected function findModel($id) 
  	{ 
	    if (($model = LpgTyreDetails::findOne($id)) !== null) {
	    	return $model;
	    }
	    else {
	      	$this->setHeader(400);
	      	echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
	      	exit;
	    }
  	}
    protected function findSum($id)
    {
        if (($model = Lexpense::find()->andWhere(['trip_id' => $id])
            ->sum('load_wages+phone+spare +cliner +driver+toll+rto+other')) !== null) {
            return $model;                    
        } else {
            return 0;
        }
    }
    protected function findLtrip($id)
    {
        if(($model = Ltrip::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 	
 	private function setHeader($status) {    
	    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
	    $content_type = "application/json";  
	    header($status_header);
	    header('Content-type: ' . $content_type);
	    header('X-Powered-By: ' . "ProZ Solutions");
  	}
    
  	private function _getStatusCodeMessage($status)	{
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
