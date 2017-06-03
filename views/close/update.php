<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */

$this->title = 'Update Ltrip: ' . $model->trip_id;
$this->params['breadcrumbs'][] = ['label' => 'Ltrips', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trip_id, 'url' => ['view', 'id' => $model->trip_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ltrip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="modal hide" id="login">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3>Log in</h3>
        </div>
        <div class="modal-body">

                <div class="form">
                <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
                ),
                )); ?>

                        <p class="note">
                                Fields with <span class="required">*</span> are required.
                        </p>

                        <div class="row">
                        <?php echo $form->labelEx($model,'username'); ?>
                        <?php echo $form->textField($model,'username',array ('name' => 'Mohamamd', 'id'=>'Mohamamd2', 'value'=>'value')); ?>
                        <?php echo $form->error($model,'username'); ?>
                        </div>

                        <div class="row">
                        <?php echo $form->labelEx($model,'password'); ?>
                        <?php echo $form->passwordField($model,'password'); ?>
                        <?php echo $form->error($model,'password'); ?>
                        </div>

                        <div class="row rememberMe">
                        <?php echo $form->checkBox($model,'rememberMe'); ?>
                        <?php echo $form->label($model,'rememberMe'); ?>
                        <?php echo $form->error($model,'rememberMe'); ?>
                        </div>
                       
                       <div class="modal-footer">
                         <a href="#" class="btn" data-dismiss="modal">Close</a>
                 <?php echo CHtml::ajaxSubmitButton('Login', array('index'), array('update'=>'#searchResults'),
                array("class"=>"btn btn-primary btn-large")
                );
                ?>
        </div>


                        <?php $this->endWidget(); ?>
                </div>
                <!-- form -->
        </div>
        
</div>