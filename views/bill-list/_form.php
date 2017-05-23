<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Vehicle;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\BillList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-list-form">
<div class="row">
<div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>

  
<?= $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->all(),'vehicle_id','vehicle_no'),['prompt'=>'Select vehicle no']) ?>
<?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(Vehicle::find()->all(),'vehicle_id','type'),['prompt'=>'Select bill type']) ?>
    <?= $form->field($model, 'type')->textInput() ?>

  <!--   <?= $form->field($model, 'from')->textInput()  ?>

    <?= $form->field($model, 'to')->textInput()  ?> -->
     <?php echo '<label>From</label>';
echo DatePicker::widget([
    'name' => 'from', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
]);?><br>
 <?php echo '<label>To</label>';
echo DatePicker::widget([
    'name' => 'to', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
]);?><br>

    <?= $form->field($model, 'amount')->textInput() ?>
<!-- 
    <?= $form->field($model, 'paid_date')->textInput()  ?>
 -->
 <?php echo '<label> Paid Date</label>';
echo DatePicker::widget([
    'name' => 'paid_date', 
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
]);?><br>

    <?= $form->field($model, 'num')->textInput()  ?>

 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
