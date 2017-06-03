<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ldiesel */

// $this->title = 'Create Ldiesel';
// $this->params['breadcrumbs'][] = ['label' => 'Ldiesels', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ldiesel-create">
<p class="btn-group"><?= Html::a('Add Diesel', ['ldiesel/index'], ['class' => 'btn btn-primary active']) ?> 
          <?= Html::a('Add Expense', ['lexpense/create'], ['class' => 'btn btn-primary ']) ?>
           <?= Html::a('Close Trip', ['close/create'], ['class' => 'btn btn-primary ']) ?>
            <?= Html::a('Trip Index', ['close/index'], ['class' => 'btn btn-danger ']) ?>  </p>
    <h1><!-- <?= Html::encode($this->title) ?> -->LPG Diesel Entry</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

