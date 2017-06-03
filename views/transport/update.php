<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transport */

$this->title = 'Update Transport';
?>
<div class="transport-update col-sm-offset-2 col-xs-offset-2">
<style type="text/css">
   	#modalclose
   	{
   		margin-top: -50px;
   		margin-right:10px;
   		background-color: darkgreen;
   		color: #fff;
   		border-radius: 15px;
   		height:30px;
   		width: 30px;
   		font-size: 24px;
   		text-align: center;
   		opacity: 1;
   	}
   </style>
    <h3><?= Html::encode($this->title) ?></h3>
<a class="close" data-dismiss="modal" id="modalclose" >&times;</a>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
