<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BillListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bill Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-list-index">
<style>
.summary{
display:none;
}
</style>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bill List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
            'label'=>'Vehicle No',
            'value' => 'vehicle.vehicle_no',
            'headerOptions' => ['style' => 'color:#337ab7'],
            ], 
            'type',            
            [            
            'label' => 'From',
            'value' => 'from',
            'headerOptions' => ['style' => 'color:#337ab7'],
             'format' => ['date','php:d-m-Y']
            ], 
              [
            
            'label' => 'To',
            'value' => 'to',
            'headerOptions' => ['style' => 'color:#337ab7'],
             'format' => ['date','php:d-m-Y']
            ], 
              [
            
            'label' => 'Paid Date',
            'value' => 'paid_date',
            'headerOptions' => ['style' => 'color:#337ab7'],
             'format' => ['date','php:d-m-Y']
            ], 
            
            'amount',
           
            'num',
        
            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
        ],
    ]); ?>
</div>
