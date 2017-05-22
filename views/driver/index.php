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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Driver', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'driver_id',
            'name',
            'license_no',
            'expiry',
            'address',
            // 'contact',
            // 'refrence',
            // 'license_type',
            // 'join_date',
            // 'is_active',
            // 'user_id',
            // 'time',
            // 'vehicle_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
