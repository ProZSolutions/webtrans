<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Card;
use app\models\Vehicle;
use app\models\Tbank;
use kartik\date\DatePicker;



/* @var $this yii\web\View */
/* @var $model app\models\Cdeposit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cdeposit-form">
    <div class="row">
    <div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'card_id')->dropDownList(ArrayHelper::map(Card::find()->all(),'card_id','card_no'),['prompt'=>'Select Card Number']) ?>

    <?= $form->field($model, 'amount')->textInput() ?>


    <?php  echo '<label> Date</label>';
    echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'date',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
    ]);
    ?><br>
 
    
    <?= $form->field($model, 'vehicle_id')->dropDownList(ArrayHelper::map(Vehicle::find()->all(),'vehicle_id','vehicle_no'),['prompt'=>'Select Vehicle Number']) ?>

    <?= $form->field($model, 'tbank_id')->dropDownList(ArrayHelper::map(Tbank::find()->all(),'tbank_id','acc_no'),['prompt'=>'Select Transport Bank Id']) ?>

    <?= $form->field($model, 'deposit_by')->textInput(['maxlength' => true]) ?>
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
