<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TbankSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbank-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tbank_id') ?>

    <?= $form->field($model, 'bank_name') ?>

    <?= $form->field($model, 'acc_no') ?>

    <?= $form->field($model, 'branch') ?>

    <?= $form->field($model, 'ifsc') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'transport_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
