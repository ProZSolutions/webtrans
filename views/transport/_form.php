<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'owner')->textInput(['style'=>'width:200px'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' :'Cancel', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-danger'])?>

    </div>
 

    <?php ActiveForm::end(); ?>

</div>
