<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CdepositSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cdeposits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdeposit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cdeposit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cdeposit_id',
            'card_id',
            'amount',
            'date',
            'time',
            // 'vehicle_id',
            // 'tbank_id',
            // 'deposit_by',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
