<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */

$this->title = 'Update Vendor';
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vendor_id, 'url' => ['view', 'id' => $model->vendor_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendor-update ">
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
    <h3 style="margin-left: 70px;"><?= Html::encode($this->title) ?></h3>
<a class="close" data-dismiss="modal" id="modalclose" >&times;</a>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
