<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */

// $this->title = 'Create Ltrip';
// $this->params['breadcrumbs'][] = ['label' => 'Ltrips', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltrip-create">
  <p class="btn-group">
        <?= Html::a('New trip', ['ltrip/index'], ['class' => 'btn btn-primary active']) ?>
        <?= Html::a('Unloading trip', ['unload/create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Closing trip', ['close/index'], ['class' => 'btn btn-primary']) ?> 
    </p>
        
    <h3><!-- <?= Html::encode($this->title) ?> -->Enter New Trip</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
