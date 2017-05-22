<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BillList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-list-form">

    <?php $form = ActiveForm::begin(); ?>

  <!--   <?= $form->field($model, 'vehicle_id')->textInput(['style'=>'width:200px']) ?> -->

    <?= $form->field($model, 'type')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'from')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'to')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'amount')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'paid_date')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'num')->textInput(['style'=>'width:200px'])  ?>

  <!--   <?= $form->field($model, 'user_id')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'time')->textInput(['style'=>'width:200px'])  ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
