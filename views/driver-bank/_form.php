<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\Driver;
/* @var $this yii\web\View */
/* @var $model app\models\Dbank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dbank-form">
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
<?php  $data = Yii::$app->getRequest()->getQueryParam('id');
?><div class="row">
<div class="col-lg-7" style="margin-left:90px">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'driver_id')->dropDownList(ArrayHelper::map(Driver::findAll($data),'driver_id','name')) ?>

    <?= $form->field($model, 'bank_name')->textInput() ?>

    <?= $form->field($model, 'acc_no')->textInput()  ?>

    <?= $form->field($model, 'branch')->textInput() ?>

    <?= $form->field($model, 'ifsc')->textInput()  ?>

  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      <!--   <?= Html::resetButton($model->isNewRecord ? 'Reset' : 'Cancel', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-danger']) ?> -->
        <?= Html::a('Cancel',['driver/index'], ['class' => 'btn btn-danger']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
</div>