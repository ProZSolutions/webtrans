<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BillList */

$this->title = 'Create Bill List';
$this->params['breadcrumbs'][] = ['label' => 'Bill Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
