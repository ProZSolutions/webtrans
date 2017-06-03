<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ldiesel */

$this->title = $model->ldiesel_id;
$this->params['breadcrumbs'][] = ['label' => 'Ldiesels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ldiesel-view">

    <h3><?= Html::encode($this->title) ?></h3>
<div class="row">
<div class="col-lg-4">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ldiesel_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ldiesel_id], [
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
            'trip_id',
            'ldiesel_id',
            'card_id',
            'fill_date',
            'diesel_price',
            'total_diesel',
            'diesel_amount',
            'payment_mode',
            'time',
            'place',
        ],
    ]) ?>

</div>
</div>
</div>