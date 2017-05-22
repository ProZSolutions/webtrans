<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dbank */

$this->title = 'Update Dbank: ' . $model->dbank_id;
$this->params['breadcrumbs'][] = ['label' => 'Dbanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dbank_id, 'url' => ['view', 'id' => $model->dbank_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dbank-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
