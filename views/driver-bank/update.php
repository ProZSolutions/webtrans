<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dbank */

$this->title = 'Update Dbank: ' . $model->dbank_id;
$this->params['breadcrumbs'][] = ['label' => 'Driver', 'url' => ['driver/index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dbank-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
