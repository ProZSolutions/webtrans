<?php

use yii\helpers\Html;
use app\models\Ltrip;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Ldiesel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ldiesel-form">
    <div class="row">
    <div class="col-lg-3">
    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'trip_id')->dropDownList(ArrayHelper::map(Ltrip::find()->andWhere(['trip_status'=>2])->all(),'trip_id','trip_no'),['prompt'=>'Select Trip No','id'=>'vehicle_id'])->label('Trip No') ?>     
    <?= $form->field($model, 'payment_mode')->dropDownList([ 'cash' => 'Cash', 'card' => 'Card', ], ['prompt' => 'Please Select Payment','id'=>'pay_mode']) ?>
    <div id='card'>
    <?= $form->field($model, 'card_id')->textInput() ?>
    </div>

    <!-- <?= $form->field($model, 'fill_date')->textInput() ?> -->
    <?php  echo '<label>Fill Date</label>';
    echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'fill_date',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
    ]);
    ?><br>

    <?= $form->field($model, 'diesel_price')->textInput(['id'=>'price']) ?>

    <?= $form->field($model, 'total_diesel')->textInput(['id'=>'diesel']) ?>

    <?= $form->field($model, 'diesel_amount')->textInput(['id'=>'amount']) ?>   

   

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
<?php 
$script = <<< JS
  $('#amount').attr('readonly', true);
$("#card").hide();
$('#pay_mode').change(function() {
    var card = $(this).val();   
   
    if(card == 'card'){
        $("#card").show();

   }
   else{
    $("#card").hide();
   }
});

$('#price,#diesel').change(function () {
    $('#amount').val(parseFloat("0"+$('#price').val()) * parseFloat("0"+$('#diesel').val()));
});


JS;
$this->registerJs($script);
?>