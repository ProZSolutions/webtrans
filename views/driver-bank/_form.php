<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dbank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dbank-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'driver_id')->textInput() ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acc_no')->textInput() ?>

    <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ifsc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
