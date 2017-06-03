<?php

use yii\helpers\Html;

use app\models\Ltrip;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="close-form col-lg-6">
<div class="row">
<div class="col-lg-6">
  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'trip_id')->dropDownList(ArrayHelper::map(Ltrip::find()->andWhere(['trip_status'=>2])->all(),'trip_id','trip_no'),['prompt'=>'Select Trip No','id'=>'vehicle_id'])->label('Trip No') ?>
  <label>Total Trip Expenses</label> <label id="tripId"></label><br><br>
 
  <label>Total Diesel Expenses</label> <label id="dieselId"></label><br><br>
  <?= $form->field($model, 'totalexpense')->textInput(['id'=>'total']) ?> 
  <?= $form->field($model, 'trip_advance')->textInput(['id'=>'adv']) ?> <label>Total</label> <label id="totexp"></label><br><br>
   
  <?= $form->field($model, 'frieght')->textInput(['id'=>'fri']) ?>      
 
  <?= $form->field($model, 'trip_profit')->textInput(['id'=>'pro']) ?>
  
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

$('#vehicle_id').change(function() {
    var vehicleNo = $(this).val();   
       
    $.get('get-loaded-vehicle',{vehicleId : vehicleNo},function(data){
        var data = $.parseJSON(data);        
        $('#tripId').html(data.trip_expenses)
        $('#dieselId').html(data.diesel_amount)
        $('#total').val(parseFloat("0"+$('#tripId').html()) + parseFloat("0"+$('#dieselId').html()));

       
    });

});
  $('#total').attr('readonly', true);
    $('#pro').attr('readonly', true);
$('#adv').change(function () {
    $('#totexp').html(parseFloat("0"+$('#total').val()) + parseFloat("0"+$('#adv').val()) );
});
$('#fri').change(function () {
    $('#pro').val(parseFloat("0"+$('#fri').val()) - parseFloat("0"+$('#totexp').html()) );
});



JS;
$this->registerJs($script);
?>