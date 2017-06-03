<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehicles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-index">
<style type="text/css">
    .summary
    {
        display: none;
    }
</style>
<div class="row">
<div class="col-lg-10">
    <h2><!-- <?= Html::encode($this->title) ?> -->View Vehicle</h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vehicle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

           'vehicle_no',
             [            
           'label'=>'Vendor Code',
            'value' => 'vendor.vendor_code',
            'headerOptions' => ['style' => 'color:#337ab7'],
            ], 
             //'type',
            [
            'label'=>'Vendor Cop',
            'value' => 'vendor.vendor_corp',
            'headerOptions' => ['style' => 'color:#337ab7'],
            ],   
          
            
            'engine_no',
            'chasis_no',
            //'corporation',

            
            // 'user_id',
            // 'time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
        ],
    ]); ?>
</div>
</div>
</div>