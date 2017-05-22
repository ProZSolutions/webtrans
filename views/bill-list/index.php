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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bill List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vehicle_id',
            'bill_id',
            'type',
            'from',
            'to',
            // 'amount',
            // 'paid_date',
            // 'num',
            // 'user_id',
            // 'time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
