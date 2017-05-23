<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tbank */

$this->title = 'Create Tbank';
$this->params['breadcrumbs'][] = ['label' => 'Tbanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
