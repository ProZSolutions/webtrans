<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ldiesel */

$this->title = 'Update Ldiesel: ' . $model->ldiesel_id;
$this->params['breadcrumbs'][] = ['label' => 'Ldiesels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ldiesel_id, 'url' => ['view', 'id' => $model->ldiesel_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ldiesel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
