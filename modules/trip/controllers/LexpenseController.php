<?php

namespace app\modules\trip\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\modules\trip\models\Lexpense;
use app\modules\trip\models\Ltrip;

class LexpenseController extends \yii\web\Controller {
    public function behaviors() {  
	    return [
	        'verbs' => [
	        'class' => VerbFilter::className(),
	        'actions' => [
	          	'index'=>['get'],    
	          	'create-expense'=>['post'],
	          	'update-expense'=>['post'],
	          	'delete-expense'=>['post'],
	          	'view-expense'=>['post'],   
	          	'get-expense'=>['post'],                               
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
	    $query ->from('lexpense AS t') //table name          
	    	->select(['t.expense_id as expenseId','t.load_wages loadWages','t.phone','t.spare','t.cliner','t.driver','t.toll','t.rto','t.other']);    
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	      
  	}  

  	public function actionViewExpense($id) {         
	    $query= new Query;
	    $query ->from('lexpense AS t')         
	    	->select(['t.trip_id as tripId','t.expense_id as expenseId','t.load_wages loadWages','t.phone','t.spare','t.cliner','t.driver','t.toll','t.rto','t.other'])
		   	->where(['expense_id'=>$id]);	           
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES);	     
  	}
  		public function actionGetExpense($id) {         
	    $query= new Query;
	    $query ->from('lexpense AS t')         
	    	->select(['t.trip_id as tripId','t.expense_id as expenseId','t.load_wages loadWages','t.phone','t.spare','t.cliner','t.driver','t.toll','t.rto','t.other'])
		   	->where(['trip_id'=>$id])
		   	->orderBy('t.expense_id DESC');	           
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES);	     
  	}  

  	public function actionCreateExpense() {     
	    $post = file_get_contents("php://input");	   
	    $params = json_decode($post, true);

	    $model = new Lexpense();  //call Transport class from model 
	    $model->trip_id = $params[0]['tripId'];  
	    //$model->driver_id = $params[0]['driverId'];   
	    $model->load_wages = $params['loadWages'];  
	    $model->phone = $params['phone'];
	    $model->spare = $params['spare'];    
	    $model->cliner = $params['cliner'];  
	    $model->driver = $params['driver']; 	     
	    $model->toll = $params['toll']; 
	    $model->rto = $params['rto']; 
	    $model->other = $params['other']; 	    
	    if ($model->save()) {   
	    	$total = $this->findSum($model->trip_id);
        	$modeltrip = $this->findLtrip($model->trip_id); 
        	$modeltrip->trip_expenses = $total;           
        	$modeltrip->save(); 

        	$modelExp = $this->findLtrip($modeltrip->trip_id); 
             $amt = $this->findSumOfExp($modelExp->trip_id);
            $pro = $modelExp->frieght;
         
           $modelExp->totalexpense = $amt ;
           $modelExp->trip_profit = $pro - $amt;
           $modelExp->save();     
	      	$this->setHeader(200);
	      	echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	      	$this->setHeader(400);
	     	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
 	}	
	
  	public function actionUpdateExpense($id) {   
	    $post = file_get_contents("php://input");	    
	    $params = json_decode($post, true);      
	    $model = new Lexpense();
	    $model = $this->findModel($id);    
	   // $model->trip_id = $params['tripId'];     
	    $model->load_wages = $params['loadWages'];  
	    $model->phone = $params['phone'];
	    $model->spare = $params['spare'];    
	    $model->cliner = $params['cliner'];  
	    $model->driver = $params['driver']; 	     
	    $model->toll = $params['toll']; 
	    $model->rto = $params['rto']; 
	    $model->other = $params['other'];      
	    if ($model->save()) {  
	    	$total = $this->findSum($model->trip_id);
        	$modeltrip = $this->findLtrip($model->trip_id); 
        	$modeltrip->trip_expenses = $total;           
        	$modeltrip->save(); 

        	// $modelExp = $this->findLtrip($modeltrip->trip_id); 
         //   $modelExp->totalexpense =  $this->findSumOfExp($modelExp->trip_id);
         //   $modelExp->save();    



           $modelExp = $this->findLtrip($modeltrip->trip_id);           
           $amt = $this->findSumOfExp($modelExp->trip_id);
           $pro = $modelExp->frieght;         
           $modelExp->totalexpense = $amt ;
           $modelExp->trip_profit = $pro - $amt;
           $modelExp->save();    
	    	$this->setHeader(200);
	      	echo json_encode(array('status'=>"success"),JSON_PRETTY_PRINT);        
	    } 
	    else {
	    	$this->setHeader(400);
	     	echo json_encode(array('status'=>"error",'data'=>array_filter($model->errors)),JSON_PRETTY_PRINT);
	    }     
  	} 
  
 	public function actionDeleteExpense($id) 
 	{           
	    $model = new Ltrip();
	    $model = $this->findModel($id);      
	    if ($model->delete()) {  
	    	
	    	$total = $this->findSum($model->trip_id);
        	$modeltrip = $this->findLtrip($model->trip_id); 
        	$modeltrip->trip_expenses = $total;           
        	$modeltrip->save(); 

        $modelExp = $this->findLtrip($modeltrip->trip_id); 
        $modelExp->totalexpense =  $this->findSumOfExp($modelExp->trip_id);
        $modelExp->save();  

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
	    if (($model = Lexpense::findOne($id)) !== null) {
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
      protected function findSumOfExp($id)
    {  
        if (($model = Ltrip::find()->andWhere(['trip_id' => $id])
            ->sum('diesel_amount + trip_expenses')) !== null) {
            return $model;            
        } else {
            return 0;
            //throw new NotFoundHttpException('The requested page does not exist.');
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
