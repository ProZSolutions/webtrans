<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Drivers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-index">
<style type="text/css">
  .summary
  {
    display: none;
  }
</style>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Driver', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= 
     GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            
           
            'name',
               [
            'label'=>'Vehicle No',
            'value' => 'vehicle.vehicle_no',
            'headerOptions' => ['style' => 'color:#337ab7'],
            ], 
            'license_no',
             [
            
            'label' => 'Expiry Date',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'value' => 'expiry',
             'format' => ['date','php:d-m-Y']
            ], 
           
            'address',
            'contact',
            'refrence',
            //'license_type',
             [
            
            'label' => 'Join Date',
            'value' => 'join_date',
            'headerOptions' => ['style' => 'color:#337ab7'],
             'format' => ['date','php:d-m-Y']
            ], 
             ['class' => 'yii\grid\ActionColumn',
              'header'=>'Bank',
         'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => '{update}{view}',

            'buttons' => [
            //'view' => function ($url, $model) {
                              //   return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url , ['class' => 'view', 'data-pjax' => '0']);
                         //  },

                'update' => function ($url, $model){
                   
                                 return  Html::a('<span class="glyphicon glyphicon-plus "></span>' , ['driver-bank/create', 'id' => $model['driver_id']], [
                                    'title' => Yii::t('yii', 'add bank'),
                                    'data-pjax' => '0',
                                    'class'=>'create',
                        ]);
                            },
                            
                              'view' => function ($url, $model){
                   
                                 return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>' , ['driver-bank/view', 'id' => $model['driver_id']], [
                                    'title' => Yii::t('yii', 'view-bank'),
                                    'data-pjax' => '0',
                                    'class'=>'view',

                        ]);
                            },

               
               
       
   

            ],
            ],
             
               ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
          
            // 'is_active',
            // 'user_id',
            // 'time',            
           
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
