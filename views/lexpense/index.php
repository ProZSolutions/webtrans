<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use yii\grid\model;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LexpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lexpenses';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="lexpense-index">
<style type="text/css">
    .summary
    {
        display: none;
    }
</style>

    <h3><!-- <?= Html::encode($this->title) ?> -->LPG Trip Expenses Details</h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    <?= Html::a('Add Trip Expense', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'trip_id',
            //'expense_id',
            'load_wages',
            'phone',
            'spare',
             'cliner',
             'driver',
            'toll',
            'rto',
            'other',
            // 'time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],
             'template' => '{update}{delete} ',
              'buttons' => [
            //'view' => function ($url, $model) {
                              //   return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url , ['class' => 'view', 'data-pjax' => '0']);
                          //  },

                'update' => function ($url, $model) {
                                 return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url , ['class' => 'update', 'data-pjax' => '0']);
                            },
                          
            ],],
        ],
    ]); ?> 
</div>