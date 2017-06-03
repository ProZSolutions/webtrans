<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Vehicle;
use app\models\Vendor;
use app\models\Settings;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-form">
<div class="row">
        <div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'vehicle_no')->textInput() ?>
   <!--  <?= $form->field($model, 'type')->dropDownList([ '2' => '2', '3' => '3', ], ['prompt' => 'Select Vehicle Type']) ?>
 -->
   <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(Settings::find()->all(),'vehicle_type','vehicle_type'),['prompt'=>'Select Vehicle Type']) ?>

    <?= $form->field($model, 'engine_no')->textInput()  ?>

    <?= $form->field($model, 'chasis_no')->textInput(['style'=>'fieldStyle : text-transform: uppercase'])  ?>
    
    <?= $form->field($model, 'vendor_id')->dropDownList(ArrayHelper::map(Vendor::find()->all(),'vendor_id','vendor_code'),['prompt'=>'Select vendor code']) ?>

  
    <div class="row">
      
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
          <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
