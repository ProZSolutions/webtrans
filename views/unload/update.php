<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */

$this->title = 'Update Ltrip: ' . $model->trip_id;
$this->params['breadcrumbs'][] = ['label' => 'Ltrips', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trip_id, 'url' => ['view', 'id' => $model->trip_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ltrip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
