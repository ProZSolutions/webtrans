<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tbank */

$this->title = $model->tbank_id;
$this->params['breadcrumbs'][] = ['label' => 'Transport banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbank-view">
    <div class="row">
      <div class="col-lg-5">
    <h3><!-- <?= Html::encode($this->title) ?> -->View Transport Bank Details</h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->tbank_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->tbank_id], [
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
            'tbank_id',
            'bank_name',
            'acc_no',
            'branch',
            'ifsc',
            'is_active',
            'user_id',
            'time',
            'transport_id',
        ],
    ]) ?>
        </div>
    </div>
</div>
