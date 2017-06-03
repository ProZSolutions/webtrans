<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Vehicle;
use app\models\Driver;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ltrip-form col-lg-6">
<div class="row">
<div class="col-lg-6">
    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->all(),'vehicle_id','vehicle_no'),['prompt'=>'Select vehicle no'])->label('Vehicle No') ?>
   <!-- <?php // $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->select('vehicle.*')->innerJoin('ltrip','`ltrip`.`vehicle_id`=`vehicle`.`vehicle_id`')->where(['ltrip.trip_status'=>1])->all(),'vehicle_id','vehicle_no'),['prompt'=>'Select vehicle no']) ?> -->



  <?= $form->field($model, 'driver_id')->dropDownList(ArrayHelper::map(Driver::find()->all(),'driver_id','name'),['prompt'=>'Select Driver Name'])->label('Driver Name') ?>

    
    <?php  echo '<label>Load Date</label>';
    echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'load_date',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
    ]);
   ?><br>
   

    <?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>



     <?= $form->field($model, 'load_weight')->textInput() ?>
     
  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
</div>