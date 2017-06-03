<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BillList */

$this->title = $model->bill_id;
$this->params['breadcrumbs'][] = ['label' => 'Bill Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-list-view">
<div class="row">
<div class="col-lg-5">
    <h3><!-- <?= Html::encode($this->title) ?> -->View Bills</h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bill_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bill_id], [
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
                'label' => 'Vechicle No',
                'value' => $model->vehicle->vehicle_no,   
                ],  
            // 'bill_id',
            'type',
            'from',
            'to',
            'amount',
            'paid_date',
            'num',
            // 'user_id',
            // 'time',
        ],
    ]) ?>

</div>
</div>
</div>