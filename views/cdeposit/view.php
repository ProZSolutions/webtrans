<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cdeposit */

$this->title = $model->cdeposit_id;
$this->params['breadcrumbs'][] = ['label' => 'deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdeposit-view">
    <div class="row">
      <div class="col-lg-5">
    <h3><!-- <?= Html::encode($this->title) ?> -->View Card Details</h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cdeposit_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cdeposit_id], [
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
            //'cdeposit_id',
             
           // 'card_id',
              [
                'label' => 'Card No',
                'value' => $model->card->card_no,   
                ],
            'amount',
            'date',

              [
                'label' => 'Vehicle No',
                'value' => $model->vehicle->vehicle_no,   
                ],
              [
                'label' => 'Account No',
                'value' => $model->tbank->acc_no,   
                ],
            'deposit_by',
            //'user_id',
        ],
    ]) ?>
        </div>
    </div>
</div>
