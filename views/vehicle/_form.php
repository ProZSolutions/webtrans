<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vendor_id')->textInput() ?>

    <?= $form->field($model, 'vehicle_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chasis_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corporation')->dropDownList([ 'IOC' => 'IOC', 'BPC' => 'BPC', 'HPC' => 'HPC', 'OTHERS' => 'OTHERS', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
