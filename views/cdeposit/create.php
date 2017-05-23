<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cdeposit */

$this->title = 'Create Cdeposit';
$this->params['breadcrumbs'][] = ['label' => 'Cdeposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdeposit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
