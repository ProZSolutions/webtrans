<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */

// $this->title = 'Create Ltrip';
// $this->params['breadcrumbs'][] = ['label' => 'Ltrips', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltrip-create">
<p class="btn-group">
        <?= Html::a('New trip', ['ltrip/index'], ['class' => 'btn btn-primary ']) ?>
        <?= Html::a('Unloading trip', ['unload/create'], ['class' => 'btn btn-primary active']) ?>
        <?= Html::a('Closing trip', ['close/index'], ['class' => 'btn btn-primary ']) ?> </p>
        
    <h1><!-- <?= Html::encode($this->title) ?> -->Enter Unload Detail</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


<div class="row" id="vehicleDetails">
  <?php $form = ActiveForm::begin(); ?>
    <label style="margin-left: -100px">Trip No : </label> <label id="tripId"></label><br><br>
    <label style="margin-left: -100px">Loading Date :</label>  <label id="loadDate"></label><br><br>
    <label style="margin-left: -100px">Source : </label>  <label id="src"></label><br><br>
    <label style="margin-left: -100px">Destination :</label> <label id="des"></label>

     <?php ActiveForm::end(); ?>

</div>
</div>
