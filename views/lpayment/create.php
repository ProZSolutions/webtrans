<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lpayment */

$this->title = 'Create Lpayment';
$this->params['breadcrumbs'][] = ['label' => 'Lpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lpayment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
