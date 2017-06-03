<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Vehicle;
use app\models\Settings;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\BillList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-list-form">
<div class="row">
<div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>

  
<?= $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->all(),'vehicle_id','vehicle_no'),['prompt'=>'Select vehicle no'])->label('Vehicle No') ?>
<?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(Settings::find()->all(),'bill_type','bill_type'),['prompt'=>'Select bill type']) ?>
 <?php  echo '<label>From</label>';
echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'from',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
]);
   ?><br>
      <?php  echo '<label>To</label>';
echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'to',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
]);
   ?><br>

    <?= $form->field($model, 'amount')->textInput() ?>

       <?php  echo '<label>Paid Date</label>';
echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'paid_date',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
]);
   ?><br>


    <?= $form->field($model, 'num')->textInput()  ?>

 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
