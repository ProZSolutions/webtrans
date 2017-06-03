<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
//use dosamigos\datepicker\DatePicker;
use kartik\date\DatePicker;
use app\models\Vehicle;
/* @var $this yii\web\View */
/* @var $model app\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">
<div class="row">
        <div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'name')->textInput()  ?>

    <?= $form->field($model, 'license_no')->textInput()  ?>

   <?php  echo '<label>Expiry Date</label>';
echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'expiry',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
]);
   ?><br>
    <?= $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->all(),'vehicle_id','vehicle_no'),['prompt'=>'Select vehicle no']) ?>

    <?= $form->field($model, 'address')->textarea(['rows'=>'3','cols'=>'10']) ?>

    <?= $form->field($model, 'contact')->textInput()  ?>

    <?= $form->field($model, 'refrence')->textInput()  ?>

   <!--  <?= $form->field($model, 'license_type')->checkBoxlist(['LPG'=>'LPG','TRAILER'=>'TRAILER','LOAD'=>'LOAD']); ?>  -->
   
     <?php  echo '<label>Join Date</label>';
echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'join_date',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
]);
   ?><br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
