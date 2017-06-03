<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lexpense */

$this->title = $model->expense_id;
$this->params['breadcrumbs'][] = ['label' => 'Lexpenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lexpense-view">
<div class="row">
<div class="col-lg-5">
    <h3><!-- <?= Html::encode($this->title) ?> -->View Expense Details</h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->expense_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->expense_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('Back',['create'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'trip_id',
            // 'expense_id',
            'load_wages',
            'phone',
            'spare',
            'cliner',
            'driver',
            'toll',
            'rto',
            'other',
            //'time',
        ],
    ]) ?>

</div>
</div>
</div>