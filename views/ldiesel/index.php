<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LdieselSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Ldiesels';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ldiesel-index">
<style type="text/css">
    .summary{
        display:none;
    }
</style>
<p class="btn-group"><?= Html::a('Add Diesel', ['ldiesel/index'], ['class' => 'btn btn-primary active']) ?> 
          <?= Html::a('Add Expense', ['lexpense/create'], ['class' => 'btn btn-primary']) ?>
           <?= Html::a('Close Trip', ['close/create'], ['class' => 'btn btn-primary ']) ?>
           <?= Html::a('Back', ['close/index'], ['class' => 'btn btn-danger ','title' => Yii::t('yii', 'Back to Close trip')]) ?>  </p>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <div class="col-lg-9">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            //'trip_id',
            //'ldiesel_id',
            [            
            'label' => 'Trip No',
            'value' => 'trip.trip_no',
            'headerOptions' => ['style' => 'color:#337ab7'],           
            ],
           
            [            
            'label' => 'Fill Date',
            'value' => 'fill_date',
            'headerOptions' => ['style' => 'color:#337ab7'],
             'format' => ['date','php:d-m-Y']
            ],
            'diesel_price',
             'total_diesel',
             'diesel_amount',
             'payment_mode',
             //'card_id',
            //'time',
             'place',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
        ],
    ]); ?>
</div>
</div>
<div class="ldiesel-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

