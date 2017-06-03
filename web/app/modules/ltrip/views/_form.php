<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltrip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vehicle_id')->textInput() ?>

    <?= $form->field($model, 'driver_id')->textInput() ?>

    <?= $form->field($model, 'load_date')->textInput() ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_km')->textInput() ?>

    <?= $form->field($model, 'corp_km')->textInput() ?>

    <?= $form->field($model, 'load_weight')->textInput() ?>

    <?= $form->field($model, 'trip_diesel')->textInput() ?>

    <?= $form->field($model, 'diesel_amount')->textInput() ?>

    <?= $form->field($model, 'unloaded_date')->textInput() ?>

    <?= $form->field($model, 'trip_advance')->textInput() ?>

    <?= $form->field($model, 'trip_expenses')->textInput() ?>

    <?= $form->field($model, 'frieght')->textInput() ?>

    <?= $form->field($model, 'trip_profit')->textInput() ?>

    <?= $form->field($model, 'payment_id')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
