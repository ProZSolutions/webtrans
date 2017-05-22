<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dbank */

$this->title = 'Create Dbank';
$this->params['breadcrumbs'][] = ['label' => 'Dbanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dbank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
