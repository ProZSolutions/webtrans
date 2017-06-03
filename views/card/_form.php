<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use  app\models\Vehicle;

/* @var $this yii\web\View */
/* @var $model app\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">
    <div  class="row">
    <div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'card_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corp')->dropDownList([ 'IOC' => 'IOC', 'HPC' => 'HPC', 'BPC' => 'BPC', 'OTHERS' => 'OTHERS', ], ['prompt' => '']) ?>

    <!-- <?= $form->field($model, 'vehicle_id')->textInput() ?>
 -->
    <?= $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->all(),'vehicle_id','vehicle_no'),['prompt'=>'Select Vehicle Number']) ?>

    <?= $form->field($model, 'cust_id')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'is_active')->textInput() ?>
 -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
