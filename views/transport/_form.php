<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transport-form">
<div class="row">
        <div class="col-lg-3">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'owner')->textInput()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' :'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger'])?>

    </div>
 </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
