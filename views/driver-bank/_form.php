<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dbank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dbank-form">

    <?php $form = ActiveForm::begin(); ?>

   <!--  <?= $form->field($model, 'driver_id')->textInput(['style'=>'width:200px'])  ?> -->

    <?= $form->field($model, 'bank_name')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'acc_no')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'branch')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'ifsc')->textInput(['style'=>'width:200px'])  ?>

    <!-- <?= $form->field($model, 'is_active')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'user_id')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'time')->textInput(['style'=>'width:200px'])  ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
