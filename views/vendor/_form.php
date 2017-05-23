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
<div class="row">
<div class="col-lg-6 col-xs-6 col-sm-6">
    <?php $form = ActiveForm::begin(); ?>


    
    <?= $form->field($model, 'transport_id')->dropDownList(ArrayHelper::map(Transport::find()->all(),'transport_id','name'),['prompt'=>'Select Transport']) ?>
    <?= $form->field($model, 'vendor_code')->textInput() ?>
    <?= $form->field($model, 'verdor_corp')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger closebutton']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
</div>
