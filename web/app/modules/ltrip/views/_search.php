<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LtripSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltrip-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'vehicle_id') ?>

    <?= $form->field($model, 'trip_id') ?>

    <?= $form->field($model, 'driver_id') ?>

    <?= $form->field($model, 'load_date') ?>

    <?= $form->field($model, 'origin') ?>

    <?php // echo $form->field($model, 'destination') ?>

    <?php // echo $form->field($model, 'total_km') ?>

    <?php // echo $form->field($model, 'corp_km') ?>

    <?php // echo $form->field($model, 'load_weight') ?>

    <?php // echo $form->field($model, 'trip_diesel') ?>

    <?php // echo $form->field($model, 'diesel_amount') ?>

    <?php // echo $form->field($model, 'unloaded_date') ?>

    <?php // echo $form->field($model, 'trip_advance') ?>

    <?php // echo $form->field($model, 'trip_expenses') ?>

    <?php // echo $form->field($model, 'frieght') ?>

    <?php // echo $form->field($model, 'trip_profit') ?>

    <?php // echo $form->field($model, 'payment_id') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
