<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin(); ?>

   <!--  <?= $form->field($model, 'vendor_id')->textInput(['style'=>'width:200px'])  ?> -->

    <?= $form->field($model, 'vehicle_no')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'engine_no')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'chasis_no')->textInput(['style'=>'width:200px'])  ?>
<div class="form-group"><div class="col-sm-3">
    <?= $form->field($model, 'corporation')->dropDownList([ 'IOC' => 'IOC', 'BPC' => 'BPC', 'HPC' => 'HPC', 'OTHERS' => 'OTHERS', ], ['prompt' => '']) ?></div></div>

    <?= $form->field($model, 'type')->textInput(['style'=>'width:200px'])  ?>

   <!--  <?= $form->field($model, 'user_id')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'time')->textInput(['style'=>'width:200px'])  ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
          <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
