<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Ltrip;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
?>

<div class="ltrip-form col-lg-6">
<div class="row">
<div class="col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
    

    <?= $form->field($model, 'trip_id')->dropDownList(ArrayHelper::map(Ltrip::find()->andWhere(['trip_status'=>1])->all(),'trip_id','vehicle.vehicle_no'),['prompt'=>'Select Vehicle No','id'=>'vehicle_id'])->label('Trip No') ?>     
    <?php  echo '<label>Unload Date</label>';
    echo DatePicker::widget([
    'model' => $model, 
    'attribute'=>'unloaded_date',
    'options' => ['placeholder' => 'dd-mm-yyyy'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose' =>true,
    ]
    ]); ?><br>
    <?= $form->field($model, 'total_km')->textInput() ?> 
    
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
       
        $('#tripId').html(data.trip_no)
        $('#loadDate').html(data.load_date)
        $('#src').html(data.origin)
        $('#des').html(data.destination)
    });

});



JS;
$this->registerJs($script);
?>