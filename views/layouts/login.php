<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html lang="<?= Yii::$app->language ?>">
<head>    
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
 <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl.'/css/bootstrap.min.css' ?>">
  <style type="text/css">
   
body{
    background-repeat:no-repeat; background-repeat:no-repeat;
   background-image:url("<?= Yii::$app->request->baseUrl.'/images/blurred-background-1.jpg' ?>");
    background-repeat:no-repeat;

}

.login_box{
    background:#F0F0F0;
    border:0.5px solid #000;
    padding-left: 15px;
    margin-bottom:25px;
    }
.input_title{
    color:#000;
    padding-left:3px;
        margin-bottom: 2px;
    }

hr{
    width:100%;
}

.login_title{
    /*font-family: "myriad-pro",sans-serif;*/
    font-style: normal;
    font-weight: 100;
    margin-left: 30%;
    color:#000;
}

.card-container.card {
    max-width: 350px;
    margin-top: 150px;

}


/*
 * Card component
 */
.card {
    background-color:#fff;
    /* just in case there no content*/
    padding: 1px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 15%x;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
   
}


.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}
.btn {
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
   /* border-radius:0.5;*/
    background:#7B72FF;
    margin-bottom:10px;
    margin-top: 10px;
    margin-left: 30%;
    color: #fff;
     height:40px;
    width: 100px;
    border-radius: 10px;

}


.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin {
    width: 100%;
    display: block;
 font-family: times new roman;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin-bottom: 10px;
}
</style>
</head>
<body>
  <div class="container">
        <div class="card card-container">
        <h2 class='login_title'>Login</h2>
        <hr>

             <?= $content ?><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
  
 


</body>
</html>