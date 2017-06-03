<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LexpenseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lexpense-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'trip_id') ?>

    <?= $form->field($model, 'expense_id') ?>

    <?= $form->field($model, 'load_wages') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'spare') ?>

    <?php // echo $form->field($model, 'cliner') ?>

    <?php // echo $form->field($model, 'driver') ?>

    <?php // echo $form->field($model, 'toll') ?>

    <?php // echo $form->field($model, 'rto') ?>

    <?php // echo $form->field($model, 'other') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
