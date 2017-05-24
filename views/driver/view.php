<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/*this makeup was to update in it*/
/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->driver_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->driver_id], [
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
            'driver_id',
            'name',
            'license_no',
            'expiry',
            'address',
            'contact',
            'refrence',
            'license_type',
            'join_date',
            'is_active',
            'user_id',
            'time',
            'vehicle_id',
        ],
    ]) ?>

</div>
