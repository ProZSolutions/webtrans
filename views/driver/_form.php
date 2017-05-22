<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'license_no')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'expiry')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'address')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'contact')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'refrence')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'license_type')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'join_date')->textInput(['style'=>'width:200px']) ?>

    <!-- <?= $form->field($model, 'is_active')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'user_id')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'time')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'vehicle_id')->textInput(['style'=>'width:200px']) ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
