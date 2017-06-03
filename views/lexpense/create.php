<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Lexpense */

// $this->title = 'Create Lexpense';
// $this->params['breadcrumbs'][] = ['label' => 'Lexpenses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="lexpense-create">
<style type="text/css">.summary{ display: none; }</style>
<p class="btn-group">
<?= Html::a('Add Diesel', ['ldiesel/index'], ['class' => 'btn btn-primary']) ?> 

          <?= Html::a('Add Expense', ['lexpense/create'], ['class' => 'btn btn-primary active']) ?>
           <?= Html::a('Close Trip', ['close/create'], ['class' => 'btn btn-primary ']) ?>
            <?= Html::a('Back', ['close/index'], ['class' => 'btn btn-danger ','title' => Yii::t('yii', 'Back to Close trip')]) ?>   </p>


    <h1><!-- <?= Html::encode($this->title) ?> -->Enter Trip Expense</h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
 <div class="col-lg-7">
 
    </div>
    

</div>
