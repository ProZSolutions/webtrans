<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Transport;


/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>

<<<<<<< HEAD
    
    <?= $form->field($model, 'transport_id')->dropDownList(ArrayHelper::map(Transport::find()->all(),'transport_id','name'),['prompt'=>'Select Transport']) ?>
=======
    <?= $form->field($model, 'transport_id')->textInput(['style'=>'width:200px'])  ?>
>>>>>>> 4d419f033bc0fc53477bcd6706154e0f9f503556

    <?= $form->field($model, 'vendor_code')->textInput(['style'=>'width:200px'])  ?>

    <?= $form->field($model, 'verdor_corp')->textInput(['style'=>'width:200px']) ?>

   <!--  <?= $form->field($model, 'user_id')->textInput(['style'=>'width:200px'])  ?>

<<<<<<< HEAD
  
=======
    <?= $form->field($model, 'time')->textInput(['style'=>'width:200px']) ?>

    <?= $form->field($model, 'is_active')->textInput(['style'=>'width:200px']) ?>
 -->
>>>>>>> 4d419f033bc0fc53477bcd6706154e0f9f503556
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
