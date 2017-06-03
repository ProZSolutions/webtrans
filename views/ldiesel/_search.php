<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LdieselSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ldiesel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'trip_id') ?>

    <?= $form->field($model, 'ldiesel_id') ?>

    <?= $form->field($model, 'card_id') ?>

    <?= $form->field($model, 'fill_date') ?>

    <?= $form->field($model, 'diesel_price') ?>

    <?php // echo $form->field($model, 'total_diesel') ?>

    <?php // echo $form->field($model, 'diesel_amount') ?>

    <?php // echo $form->field($model, 'payment_mode') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'place') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
