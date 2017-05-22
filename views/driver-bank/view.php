<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dbank */

$this->title = $model->dbank_id;
$this->params['breadcrumbs'][] = ['label' => 'Dbanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dbank-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dbank_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dbank_id], [
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
            'dbank_id',
            'driver_id',
            'bank_name',
            'acc_no',
            'branch',
            'ifsc',
            'is_active',
            'user_id',
            'time',
        ],
    ]) ?>

</div>
