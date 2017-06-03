<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DbankSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dbank-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dbank_id') ?>

    <?= $form->field($model, 'driver_id') ?>

    <?= $form->field($model, 'bank_name') ?>

    <?= $form->field($model, 'acc_no') ?>

    <?= $form->field($model, 'branch') ?>

    <?php // echo $form->field($model, 'ifsc') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
