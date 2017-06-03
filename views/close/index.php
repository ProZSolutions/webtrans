<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use yii\widget\Pjax;
//use yii\bootstrap\Modal;
//use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\LtripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Ltrips';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltrip-index">
<style type="text/css">
    .summary
    {
        display: none;
    }
</style>
<div class="row">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <p class="btn-group"><?= Html::a('New trip', ['ltrip/index'], ['class' => 'btn btn-primary ']) ?>
        <?= Html::a('Unloading trip', ['unload/create'], ['class' => 'btn btn-primary ']) ?>
        <?= Html::a('Closing trip', ['close/index'], ['class' => 'btn btn-primary active ']) ?> </p><br>
         <h3>Close Trip</h3>
       <p class="btn-group"><?= Html::a('Add Diesel', ['ldiesel/index'], ['class' => 'btn btn-primary']) ?> 
          <?= Html::a('Add Expense', ['lexpense/create'], ['class' => 'btn btn-primary']) ?>
           <?= Html::a('Trip Close', ['close/create'], ['class' => 'btn btn-primary']) ?> </p>
<!--  <p>
        <?= Html::a('Create Ltrip', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
   <!--  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
        ],
    ]); ?> -->
</div>
</div>