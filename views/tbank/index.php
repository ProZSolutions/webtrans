<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TbankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbank-index">
<style>
.summary{
display:none;
}
</style>
   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="row">
<div class="col-lg-8">
<h3>View Transport Bank Details</h3>
    <p>
        <?= Html::a('Create bank', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'tbank_id',
            'bank_name',
            'acc_no',
            'branch',
            'ifsc',
            // 'is_active',
            // 'user_id',
            // 'time',
            // 'transport_id',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
        ],
    ]); ?>
</div>
</div>
</div>