<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DbankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dbanks';
$this->params['breadcrumbs'][] = 'Driver';
?>
<div class="dbank-index">
<style type="text/css">
    .summary
    {
        display: none;
    }
</style>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dbank', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'dbank_id',
            'driver_id',
            'bank_name',
            'acc_no',
            'branch',
            // 'ifsc',
            // 'is_active',
            // 'user_id',
            // 'time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
