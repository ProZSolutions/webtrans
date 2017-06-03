<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Transport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transport-form">
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
<div class="row" >
        <div class="col-lg-6" >

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'owner')->textInput()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

      <!--   <?= Html::Button($model->isNewRecord ? 'Reset' :'Close', ['data-dismiss'=>'model','class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-danger'])?>
 -->
             <?= Html::a('Cancel',['index'], ['class' => 'btn btn-danger']) ?>

    </div>
 </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
</div>

