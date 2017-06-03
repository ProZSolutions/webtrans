<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */

$this->title = $model->vehicle_id;
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-view">
<div class="row">
<div class="col-lg-5">
    <h3><!-- <?= Html::encode($this->title) ?> -->View Vehicle</h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->vehicle_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->vehicle_id], [
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
           
            'vehicle_no',
            'engine_no',
            'chasis_no',
             [
                'label' => 'Vendor Code',
                'value' => $model->vendor->vendor_code,   
                ],
            [
                'label' => 'Corporation',
                'value' => $model->vendor->vendor_corp,   
                ],
            //'type',
           
        ],
    ]) ?>

</div>
</div>
</div>