<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cdeposit */

$this->title = 'Update deposit: ' . $model->cdeposit_id;
$this->params['breadcrumbs'][] = ['label' => 'Cdeposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cdeposit_id, 'url' => ['view', 'id' => $model->cdeposit_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cdeposit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
