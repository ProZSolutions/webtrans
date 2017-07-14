<?php

namespace app\modules\payment\controllers;

class LpaymentController extends \yii\web\Controller
{
     public function behaviors()
  	{  
	    return [
	        'verbs' => [
		        'class' => VerbFilter::className(),
		        'actions' => [
		          	'index'=>['get'],    
		          	'create-payment'=>['post'],		          
		          	'update-payment'=>['post'],
		          	'delete-payment'=>['post'],	
		                            
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

}
