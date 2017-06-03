<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tbank */

$this->title = 'Update bank: ' . $model->tbank_id;
$this->params['breadcrumbs'][] = ['label' => 'Transport banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tbank_id, 'url' => ['view', 'id' => $model->tbank_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbank-update">

    <h2><!-- <?= Html::encode($this->title) ?> -->Update Bank Details</h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
