<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */

$this->title = $model->trip_id;
$this->params['breadcrumbs'][] = ['label' => 'Ltrips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltrip-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->trip_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->trip_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'vehicle_id',
            'trip_id',
            'driver_id',
            'load_date',
            'origin',
            'destination',
            'total_km',
            'corp_km',
            'load_weight',
            'trip_diesel',
            'diesel_amount',
            'unloaded_date',
            'trip_advance',
            'trip_expenses',
            'frieght',
            'trip_profit',
            'payment_id',
            'time',
            'user_id',
        ],
    ]) ?>

</div>
