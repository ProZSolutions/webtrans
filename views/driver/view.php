<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-view">
<div class="row">
<div class="col-lg-5">
    <h3><!-- <?= Html::encode($this->title) ?> -->View driver Details</h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->driver_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->driver_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('Back',['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
              [
                'label' => 'Vehicle No',
                'value' => $model->vehicle->vehicle_no,   
                ],
            'name',
            'license_no',
            'expiry',
            'address',
            'contact',
            'refrence',
            //'license_type',
            'join_date',
            //'is_active',
            //'user_id',
            //'time',
            //'vehicle_id',
        ],
    ]) ?>

</div>
</div>
</div>