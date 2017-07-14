<?php

namespace app\modules\trip\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use app\modules\trip\models\Ltrip;
use app\models\Vehicle;
use app\models\Dpayment;
use app\modules\payment\models\Lpayment;
use app\modules\trip\models\Lexpense;

class LtripController extends \yii\web\Controller
{
    public function behaviors()
  	{  
	    return [
	        'verbs' => [
		        'class' => VerbFilter::className(),
		        'actions' => [
		          	'index'=>['get'],    
		          	'create-ltrip'=>['post'],
		          	'unload-ltrip'=>['post'],
		          	'update-ltrip'=>['post'],
		          	'delete-ltrip'=>['post'],    
		          	'close-ltrip'=>['post'],  
		          	'search-trip'=>['post'],  
		          	'run-vehicle'=>['get'], 
		          	'get-card'=>['get'], 
		          	'view-ltrip'=>['post'], 
		          	'advance'=>['post'],
		          	'unload-vehicle'=>['get'],
		          	'close-vehicle'=>['get'],
		                            
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
	  		$models = Ltrip::getLtripDetails();
	    	$this->setHeader(200);     
	    	echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	   
  	} 
  	public function actionViewLtrip($id) {         
	  		$models = Ltrip::getLtrip($id);
	    	$this->setHeader(200);     
	    	echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	   
  	}
  	public function actionRunVehicle() {         
	  		$models = Ltrip::getRun();
	    	$this->setHeader(200);     
	    	echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	   
  	}
  	public function actionUnloadVehicle() {         
	  		$models = Ltrip::getUnload();
	    	$this->setHeader(200);     
	    	echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	   
  	}
  	public function actionCloseVehicle() {         
	  		$models = Ltrip::getClose();
	    	$this->setHeader(200);     
	    	echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	   
  	} 
  	public function actionGetCard() {         
	  		$models = Ltrip::getCard();
	    	$this->setHeader(200);     
	    	echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	   
  	}  
  	public function actionCreateLtrip() {        
	    $post = file_get_contents("php://input");	   
	    $params = json_decode($post, true);	       
	    $model = new Ltrip();     
	    $model->vehicle_id = $params['vehicleId'];  
	    $model->driver_id = $params['driverId'];
	    $model->trip_no = $params['tripNo'];
	    $model->load_date = date('Y-m-d', strtotime($params['loadDate']));    
	    $model->origin = $params['origin'];  
	    $model->destination = $params['destination']; 	     
	    $model->load_weight = $params['loadWeight'];
	    $model->trip_status = 2;	   
	    if ($model->save()) { 
	    $data = $this->findVehicle($model->vehicle_id); 
	    $data->ltrip = 1;
	    $data->save();

	    $exp = new Lexpense();
	    $exp->trip_id = $model->trip_id;
	    $exp->save();

	    $Lpay = new Lpayment();
	   	$Lpay->trip_id = $model->trip_id;
	   	$Lpay->save(); 

	      	$this->setHeader(200);
	    	echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	    	$this->setHeader(400);
	    	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
 	} 
 	public function actionUnloadLtrip($id) {     
	    $post = file_get_contents("php://input");	   
	    $params = json_decode($post, true);
	    $model = new Ltrip(); 
	    $model = $this->findModel($id);        
	    $model->unloaded_date = date('Y-m-d', strtotime($params['unloadDate']));     
	    $model->total_km = $params['totalKm']; 
	     $model->trip_status = 1;	  
	    if ($model->save()) {      
	    	$this->setHeader(200);
	    	echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	    	$this->setHeader(400);
	    	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
 	} 
 	public function actionAdvance() {  
	    $post = file_get_contents("php://input");	   
	    $params = json_decode($post, true);	  
	    $model = $this->findModel($params[0]['tripId']); 
	    $model->trip_advance = $params['amount'];    
	    if ($model->save()) {
			    $pay = new Dpayment();
			    $pay->driver_id = $params[0]['driverId'];  
    			$pay->mode = $params['payMode'];   
    			$pay->amount = $params['amount']; 
    			if($pay->mode == 'account') {
    				$pay->dbank_id = $params[0]['bankId'];  
				}
    			$pay->date = date('Y-m-d', strtotime($params['fillDate']));
    			$pay->for = 'adv'; 
    			$pay->trip_id = $params[0]['tripId']; 
			   $pay->save();


			    $total = $this->sumOfAdvance($model->trip_id); 
			    $modeltrip = $this->findModel($model->trip_id);
        		$modeltrip->trip_advance = $total;           
        		$modeltrip->save(); 
        	
			    $modelExp = $this->findModel($model->trip_id); 
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
 	public function actionCloseLtrip($id) {  	    
	    $post = file_get_contents("php://input");	   
	    $params = json_decode($post, true);	 	  
	    $model = $this->findModel($id); 
	    $model->frieght = $params['frieght'];  
	    $model->trip_profit = $params['totalexpense']-$params['frieght'];
	    $model->trip_status = 0;

	    if($model->save()) { 
	  		$Lpay = $this->findLpay($id);
	    	$Lpay->total_frieght = $params['frieght'];
	    	$Lpay->save(); 

	    	$vehicle = $this->findVehicle($model->vehicle_id); 
	    	$vehicle->ltrip = 0;
	    	$vehicle->save(); 
	    	
	      	$this->setHeader(200);
	      	echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	      	$this->setHeader(400);
	     	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
 	} 	
  	public function actionUpdateLtrip($id) {   
	    $post = file_get_contents("php://input");	    
	    $params = json_decode($post, true);      
	    $model = new Ltrip();
	    $model = $this->findModel($id);    
	    $model->vehicle_id = $params['vehicleId'];  
	    $model->driver_id = $params['driverId'];
	    $model->load_date = date('Y-m-d', strtotime($params['loadDate']));    
	    $model->origin = $params['origin'];  
	    $model->destination = $params['destination']; 	     
	    $model->load_weight = $params['loadWeight'];      
	    if ($model->save()) {      
	      	$this->setHeader(200);
	      	echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	      	$this->setHeader(400);
	     	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
  	}   
 	public function actionDeleteLtrip($id) {           
	    $model = new Ltrip();
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
  	
 	public function actionSearchTrip(){
	 	$request = Yii::$app->request;
	    $param = $request->get();
	   	$lower = $param['from'];
	   	$upper = $param['to'];
	   	$tripNo = $param['tripNo'];
	   	$data = $this->getTripBetweenDates($lower, $upper, $tripNo); 
		    $this->setHeader(200);     
		    echo json_encode(array('data'=>array_filter($data)),JSON_UNESCAPED_SLASHES); 	   
 	}

 	protected function getTripBetweenDates($lower, $upper, $bookName) {	
		$query = new Query;//refer from use yii\db\Query.It is initialize start the prg
	    $query ->from('ltrip AS t') //table name          
	    		->select(['t.trip_no AS tripNo','t.load_date as loadDate','t.origin','t.destination','t.total_km as totalKm','t.corp_km as corpKm','t.load_weight as loadWeight','t.trip_diesel as tripDiesel','t.diesel_amount as dieselAmount','t.unloaded_date as unloadedDate','t.trip_advance AS tripDavance','t.trip_expenses as tripExpense','t.frieght','t.totalexpense','t.trip_profit as tripProfit'])		   
		   	->where(["between","t.load_date", $lower, $upper])
		    ->andWhere(["t.trip_no"=>$bookName]);		              
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    return $models;
	}
	protected function findVehicle($id) { 
    if (($model = Vehicle::findOne(['vehicle_id' => $id])) !== null) {
      return $model;
    }
    else {
      $this->setHeader(400);
      echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
      exit;
    }
  	}
  	
  	protected function sumOfAdvance($id) { 
    if (($model = Dpayment::find()->andWhere(['trip_id' => $id,'for'=>'adv'])
    	->sum('amount')) !== null) {
      return $model;
    }
    else {
    	return 0;
      }
	}
  
  	protected function findModel($id) { 

	    if (($model = Ltrip::findOne(['trip_id' => $id])) !== null) {
	    return $model;
	    }
	    else {
	      $this->setHeader(400);
	      echo json_encode(array('status'=>"error",'data'=>array('message'=>'Bad request')),JSON_PRETTY_PRINT);
	      exit;
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
      protected function findLpay($id)
    {  
        if (($model = Lpayment::findOne(['trip_id' => $id])) !== null) {
            return $model;           
        } else {
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
