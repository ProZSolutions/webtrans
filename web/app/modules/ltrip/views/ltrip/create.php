<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ltrip */

$this->title = 'Create Ltrip';
$this->params['breadcrumbs'][] = ['label' => 'Ltrips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltrip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
