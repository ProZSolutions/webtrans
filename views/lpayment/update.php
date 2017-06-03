<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lpayment */

$this->title = 'Update Lpayment: ' . $model->payment_id;
$this->params['breadcrumbs'][] = ['label' => 'Lpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->payment_id, 'url' => ['view', 'id' => $model->payment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lpayment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
