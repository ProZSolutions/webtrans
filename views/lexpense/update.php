<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lexpense */

$this->title = 'Update Lexpense: ' . $model->expense_id;
$this->params['breadcrumbs'][] = ['label' => 'expenses', 'url' => ['create']];
$this->params['breadcrumbs'][] = ['label' => $model->expense_id, 'url' => ['view', 'id' => $model->expense_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lexpense-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
