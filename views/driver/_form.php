<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">
<div class="row">
        <div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>
    <?php echo '<label>Check Issue Date</label>';
echo DatePicker::widget([
    'name' => 'check_issue_date', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
]);?>

    <?= $form->field($model, 'name')->textInput()  ?>

    <?= $form->field($model, 'license_no')->textInput()  ?>

    <?= $form->field($model, 'expiry')->textInput() ?>

    <?= $form->field($model, 'address')->textInput() ?>

    <?= $form->field($model, 'contact')->textInput()  ?>

    <?= $form->field($model, 'refrence')->textInput()  ?>

    <?= $form->field($model, 'license_type')->textInput()  ?>

 <?php echo '<label>Check Issue Date</label>';
echo DatePicker::widget([
    'name' => 'join_date', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
]);?>

     
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
