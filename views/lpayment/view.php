<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lpayment */

$this->title = $model->payment_id;
$this->params['breadcrumbs'][] = ['label' => 'Lpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lpayment-view">
<div class="row">
<div class="col-lg-5"
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->payment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->payment_id], [
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
            'payment_id',
            'trip_id',
            'reference_no',
            'payment_date',
            'total_frieght',
            'vehicle_id',
            'tbank_id',
            'card_id',
            'card_amount',
            'user_id',
            'time',
        ],
    ]) ?>

</div>
</div>
</div>