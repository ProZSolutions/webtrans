<?php

namespace app\modules\trip\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\modules\trip\models\Ldiesel;
use app\modules\trip\models\Ltrip;

class LdieselController extends \yii\web\Controller
{
    public function behaviors()
  	{  
	    return [
	        'verbs' => [
	        'class' => VerbFilter::className(),
	        'actions' => [
	          	'index'=>['get'],    
	          	'create-diesel'=>['post'],          
	          	'update-diesel'=>['post'],
	          	'delete-diesel'=>['post'],    
	          	'view-diesel'=>['get'],
	          	'get-diesel'=>['post'],                       
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
	    $query ->from('ldiesel AS d')     
	    	->select(['d.ldiesel_id as dieselId','d.payment_mode as payMode','d.card_id as cardId','card.card_no as cardNo',"DATE_FORMAT(d.fill_date, '%d-%m-%Y') as fillDate",'d.diesel_price as dieselPrice','d.total_diesel as totalDiesel','d.diesel_amount as dieselAmount','d.place'])
	    	->leftJoin('card', 'card.card_id = d.card_id')  ;	           
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 
	      
  	} 
  	public function actionViewDiesel($id) {         
	    $query= new Query;
	    $query ->from('ldiesel AS d')     
	    	->select(['d.trip_id as tripId','d.ldiesel_id as dieselId','d.payment_mode as payMode','d.card_id as cardId','card.card_no as cardNo',"DATE_FORMAT(d.fill_date, '%d-%m-%Y') as fillDate",'d.diesel_price as dieselPrice','d.total_diesel as totalDiesel','d.diesel_amount as dieselAmount','d.place'])
	    	->leftJoin('card', 'card.card_id = d.card_id') 
	    	->andWhere(['d.ldiesel_id'=> $id]);	           
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	      
  	} 
  	public function actionGetDiesel($id) {         
	    $query= new Query;
	    $query ->from('ldiesel AS d')     
	    	->select(['d.trip_id as tripId','d.ldiesel_id as dieselId','d.payment_mode as payMode','card.card_no as cardNo',"DATE_FORMAT(d.fill_date, '%d-%m-%Y') as fillDate",'d.diesel_price as dieselPrice','d.total_diesel as totalDiesel','d.diesel_amount as dieselAmount','d.place'])
	    	->leftJoin('card', 'card.card_id = d.card_id') 
	    	->andWhere(['d.trip_id'=> $id])
	    	->orderBy('d.ldiesel_id DESC');;	           
	    $command = $query->createCommand();
	    $models = $command->queryAll();  
	    $this->setHeader(200);     
	    echo json_encode(array_filter($models),JSON_UNESCAPED_SLASHES); 	      
  	}   

  	public function actionCreateDiesel() {     
	    $post = file_get_contents("php://input");	   
	    $params = json_decode($post, true);	 

	    $model = new Ldiesel();  
	    $model->trip_id = $params[0]['tripId'];  
	    $model->payment_mode = $params['payMode'];
	    $model->fill_date = date('Y-m-d', strtotime($params['fillDate']));    
	    if($model->payment_mode == 'Card') {   
	    	$model->card_id = $params['cardId']; 
	    } 
	    $model->diesel_price = $params['dieselPrice']; 	     
	    $model->total_diesel = $params['totalDiesel'];
	    $model->diesel_amount = $params['dieselPrice']*$params['totalDiesel']; 
	    $model->place = $params['place']; 	    
	    if($model->save()) { 	    	
	    	$total = $this->findSum($model->trip_id);
            $totDiesel = $this->findSumDiesel($model->trip_id);
            
            $modeltrip = $this->findLtrip($model->trip_id);            
            $modeltrip->trip_diesel = $totDiesel; 
            $modeltrip->diesel_amount = $total;          
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
 
  	public function actionUpdateDiesel($id) {   
	    $post = file_get_contents("php://input");	    
	    $params = json_decode($post, true); 	   
	    $model = $this->findModel($id);    
	   	//$model->trip_id = $params['tripId'];  
	    $model->payment_mode = $params['payMode'];
	    $model->fill_date = date('Y-m-d', strtotime($params['fillDate'])); 
	    if($model->payment_mode == 'Card') {   
	    	$model->card_id = $params['cardId'];
	    } 
	    $model->diesel_price = $params['dieselPrice']; 	     
	    $model->total_diesel = $params['totalDiesel'];
	    $model->diesel_amount = $params['dieselPrice']*$params['totalDiesel']; 
	    $model->place = $params['place'];      
	    if ($model->save()) {  

	    	$total = $this->findSum($model->trip_id);
            $totDiesel = $this->findSumDiesel($model->trip_id);
            $modeltrip = $this->findLtrip($model->trip_id);          
            $modeltrip->trip_diesel = $totDiesel;
            $modeltrip->diesel_amount = $total;            
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
   
 	public function actionDeleteDiesel($id) {  
	    $model = $this->findModel($id); 	     
	    if ($model->delete()) { 
	    	$total = $this->findSum($model->trip_id);
            $totDiesel = $this->findSumDiesel($model->trip_id);
            $modeltrip = $this->findLtrip($model->trip_id);            
            $modeltrip->trip_diesel = $totDiesel;
            $modeltrip->diesel_amount = $total;           
            $modeltrip->save(); 
            $modelExp = $this->findLtrip($model->trip_id); 
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
  	
  	protected function findModel($id) { 
	    if (($model = Ldiesel::findOne($id)) !== null) {
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
        if (($model = Ldiesel::find()->andWhere(['trip_id' => $id])
            ->sum('diesel_amount')) !== null) {
            return $model;            
        } else {
            return 0;
            //throw new NotFoundHttpException('The requested page does not exist.');
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
    protected function findSumDiesel($id)
    {
        if (($model = Ldiesel::find()->andWhere(['trip_id' => $id])
            ->sum('total_diesel')) !== null) {
            return $model;            
        } else {
            return 0;
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findLtrip($id)
    {  
        if (($model = Ltrip::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
