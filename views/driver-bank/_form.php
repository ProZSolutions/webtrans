<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dbank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dbank-form">
<div class="row">
<div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>

   <!--  <?= $form->field($model, 'driver_id')->textInput()  ?> -->

    <?= $form->field($model, 'bank_name')->textInput() ?>

    <?= $form->field($model, 'acc_no')->textInput()  ?>

    <?= $form->field($model, 'branch')->textInput() ?>

    <?= $form->field($model, 'ifsc')->textInput()  ?>

    <!-- <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput()  ?>

    <?= $form->field($model, 'time')->textInput()  ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
