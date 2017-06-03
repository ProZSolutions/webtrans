<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\Transport;
use app\models\Settings;





/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form ">
<style type="text/css">

    @media screen and (min-width: 768px) {

        .modal-dialog {

          width: 400px; /* New width for default modal */

        }

        .modal-sm {

          width: 350px; /* New width for small modal */

        }

    }

    @media screen and (min-width: 992px) {

        .modal-lg {

          width: 950px; /* New width for large modal */

        }

    }
</style>
<div class="row" style="margin-left: 60px;">

<div class="col-lg-6">
    <?php $form = ActiveForm::begin(); ?>


    
    <?= $form->field($model, 'transport_id')->dropDownList(ArrayHelper::map(Transport::find()->all(),'transport_id','name'),['prompt'=>'Select Transport'],['class'=>'dropDownList']) ?>
    <?= $form->field($model, 'vendor_code')->textInput()  ?>

   
<!-- <?= $form->field($model, 'vendor_corp')->dropDownList([ 'IOC' => 'IOC', 'BPC' => 'BPC', 'HPC' => 'HPC', 'OTHERS' => 'OTHERS', ], ['prompt' => '']) ?> -->

<?= $form->field($model, 'vendor_corp')->dropDownList(ArrayHelper::map(Settings::find()->all(),'corporation','corporation'),['prompt'=>'Select vendor corporation']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
       <!--  <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger closebutton']) ?> -->
         <?= Html::a('Cancel',['index'], ['class' => 'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

</div>

</div>



