<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dbank */

$this->title = 'Create Dbank';
$this->params['breadcrumbs'][] = ['label' => 'Dbanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dbank-create">
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
    <h3 style="margin-left: 90px;"><!-- <?= Html::encode($this->title) ?> -->Create Driver Bank</h3>
 <a class="close" data-dismiss="modal" id="modalclose" >&times;</a>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
