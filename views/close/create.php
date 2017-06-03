<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use app\models\Lexpense;
//use app\models\Ltrip;


/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */

// $this->title = 'Create Ltrip';
// $this->params['breadcrumbs'][] = ['label' => 'Ltrips', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="ltrip-create">
<p class="btn-group"><?= Html::a('Add Diesel', ['ldiesel/index'], ['class' => 'btn btn-primary']) ?> 
          <?= Html::a('Add Expense', ['lexpense/create'], ['class' => 'btn btn-primary ']) ?>
           <?= Html::a('Close Trip', ['close/create'], ['class' => 'btn btn-primary active ']) ?>
           <?= Html::a('Back', ['close/index'], ['class' => 'btn btn-danger ','title' => Yii::t('yii', 'Back to Close trip')]) ?>  </p>
    <h3><!-- <?= Html::encode($this->title) ?> -->Enter Closing Load Details</h3>
   <?= $this->render('_form', [
        'model' => $model,
    ]) ?> 


</div>
