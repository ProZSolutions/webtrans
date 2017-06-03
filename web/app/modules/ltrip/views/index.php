<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ltrips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltrip-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ltrip', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vehicle_id',
            'trip_id',
            'driver_id',
            'load_date',
            'origin',
            // 'destination',
            // 'total_km',
            // 'corp_km',
            // 'load_weight',
            // 'trip_diesel',
            // 'diesel_amount',
            // 'unloaded_date',
            // 'trip_advance',
            // 'trip_expenses',
            // 'frieght',
            // 'trip_profit',
            // 'payment_id',
            // 'time',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
