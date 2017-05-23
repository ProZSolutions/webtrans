<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Vehicle;
use app\models\Vendor;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-form">
<div class="row">
        <div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>

   <!--  <?= $form->field($model, 'vendor_id')->textInput()  ?> -->

    <?= $form->field($model, 'vehicle_no')->textInput() ?>
    <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(Vehicle::find()->all(),'vehicle_no','type'),['prompt'=>'Select Transport']) ?>


  <?= $form->field($model, 'engine_no')->textInput()  ?>

    <?= $form->field($model, 'chasis_no')->textInput(['style'=>'fieldStyle : text-transform: uppercase'])  ?>
    <?= $form->field($model, 'corporation')->dropDownList([ 'IOC' => 'IOC', 'BPC' => 'BPC', 'HPC' => 'HPC', 'OTHERS' => 'OTHERS', ], ['prompt' => '']) ?>
  <!--   <?= $form->field($model, 'vendor_id')->dropDownList(ArrayHelper::map(Vendor::find()->all(),'vendor_id','verdor_code'),['prompt'=>'Select verdeor code']) ?> -->
 <label>Transport Name</label>
 <label style="margin-left: 50px;">Corporation</label>
    <div class="form-group ">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
          <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
   
</div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
