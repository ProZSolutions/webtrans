<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Driver;
use yii\widgets\ActiveForm;

//use CHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Ltrips';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltrip-index">
<style type="text/css">
    .summary
    {
        display:none;
    }
</style>
  <p class="btn-group">
        <?= Html::a('New trip', ['ltrip/index'], ['class' => 'btn btn-primary active']) ?>
        <?= Html::a('Unloading trip', ['unload/create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Closing trip', ['close/index'], ['class' => 'btn btn-primary']) ?> 
       
    </p>
    <h3><!-- <?= Html::encode($this->title) ?> -->LPG Trip Details</h3>
    <p><?= Html::a('Add trip', ['ltrip/create'], ['class' => 'btn btn-success']) ?></p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           // 'vehicle_id',
             [
            'label'=>'Vehicle No',
            'value' => 'vehicle.vehicle_no',
            //'filter'=>CHtml::listData(Model::model()->findAll('condition_if_any'),'no'),
            'headerOptions' => ['style' => 'color:#337ab7'],
            //'filter'=>true,

            ], 
             'trip_no',
            //'driver_id',
             [
            'label'=>'Driver Name',
            'value' => 'driver.name',
            'headerOptions' => ['style' => 'color:#337ab7'],
            ], 
           // 'load_date',
            'origin',
            'destination',
           'total_km',
            //'corp_km',
            //'load_weight',
            'trip_diesel',
            'diesel_amount',
            'unloaded_date',
            'trip_advance',
            'trip_expenses',
            'frieght',
            'trip_profit',
            //'diesel_expenses',
            
        //     ['class' => 'yii\grid\ActionColumn',
        //       'header'=>'Trip Expenses',
        //  'headerOptions' => ['style' => 'color:#337ab7'],
        // 'template' => '{view}',

        //     'buttons' => [
        //     //'view' => function ($url, $model) {
        //                       //   return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url , ['class' => 'view', 'data-pjax' => '0']);
        //                  //  },

        //         // 'update' => function ($url, $model){
                   
        //         //                  return  Html::a('<span class="glyphicon glyphicon-plus "></span>' , ['lexpenses/index', 'id' => $model['driver_id']], [
        //         //                     'title' => Yii::t('yii', 'add bank'),
        //         //                     'data-pjax' => '0',
        //         //                     'class'=>'create',
        //         //         ]);
        //         //             },
                            
        //                       'view' => function ($url, $model){
                   
        //                          return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>' , ['lexpense/index', 'id' => $model['driver_id']], [
        //                             'title' => Yii::t('yii', 'view-bank'),
        //                             'data-pjax' => '0',
        //                             'class'=>'view',

        //                 ]);
        //                     },

               
               
       
   

        //     ],
        //     ],
              
            // 'time',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
        ],
    ]); 

    $this->registerJs(
  "$(document).on('ready pjax:success', function() {  // 'pjax:success' use if you have used pjax
    $('.create').click(function(e){
       e.preventDefault();      
       $('#pModal').modal('show')
                  .find('.modal-content')
                  .load($(this).attr('href'));  

   });
})
");
yii\bootstrap\Modal::begin([
    'id'=>'pModal',
   
]);

 yii\bootstrap\Modal::end();


  

    
?>
</div>

