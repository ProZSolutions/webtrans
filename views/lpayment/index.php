<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lpayments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lpayment-index">
<style type="text/css">
    .summary{
        display: none;
    }
</style>
<div class="row">
<div class="col-lg-10">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lpayment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            'payment_id',
            'trip_id',
            'reference_no',
            'payment_date',
            'total_frieght',
            // 'vehicle_id',
            // 'tbank_id',
            // 'card_id',
            // 'card_amount',
            // 'user_id',
            // 'time',

            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
        ],
    ]); ?>
</div>
</div>
</div>