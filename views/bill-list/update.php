<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BillList */

$this->title = 'Update Bill List: ' . $model->bill_id;
$this->params['breadcrumbs'][] = ['label' => 'Bill Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bill_id, 'url' => ['view', 'id' => $model->bill_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bill-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
