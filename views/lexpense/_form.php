<?php

use yii\helpers\Html;
use app\models\Ltrip;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Lexpense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lexpense-form col-lg-5">
<div class="row">
<div class="col-lg-7">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trip_id')->dropDownList(ArrayHelper::map(Ltrip::find()->andWhere(['trip_status'=>2])->all(),'trip_id','trip_no'),['prompt'=>'Select Trip No','id'=>'vehicle_id'])->label('Trip No') ?>  

    <?= $form->field($model, 'load_wages')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'spare')->textInput() ?>

    <?= $form->field($model, 'cliner')->textInput() ?>

    <?= $form->field($model, 'driver')->textInput() ?>

    <?= $form->field($model, 'toll')->textInput() ?>

    <?= $form->field($model, 'rto')->textInput() ?>

    <?= $form->field($model, 'other')->textInput() ?>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>

</div>
