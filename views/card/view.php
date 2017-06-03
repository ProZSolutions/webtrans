<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Card */

$this->title = $model->card_id;
$this->params['breadcrumbs'][] = ['label' => 'Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-view">
    <div class="row">
      <div class="col-lg-5">
    <h3><!-- <?= Html::encode($this->title) ?> -->View cards</h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->card_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->card_id], [
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
            //'card_id',
            'card_no',
            'corp',
            // 'vehicle_id',
            // 'cust_id',
            // 'is_active',
        ],
    ]) ?>
        </div>
    </div>
</div>
