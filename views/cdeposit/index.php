<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CdepositSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Card deposits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdeposit-index">
<style>
.summary{
display:none;
}
</style>
    <h1><!-- <?= Html::encode($this->title) ?> -->Card Deposit</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create deposit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
    <div class="col-lg-10 ">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'cdeposit_id',
                    
            ['label'=>'Vehicle no','value'=>'vehicle.vehicle_no',
            'headerOptions' => ['style' => 'color:#337ab7'],
            ],
            'amount',
              ['label'=>'Card Number','value'=>'card.card_no',
              'headerOptions' => ['style' => 'color:#337ab7'],
            ],
            [            
            'label' => 'Date',
            'value' => 'date',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'format' => ['date','php:d-m-Y']
            ],
            //'time',
            
             ['label'=>'Account No','value'=>'tbank.acc_no',
              'headerOptions' => ['style' => 'color:#337ab7'],
            ],
            'deposit_by',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],],
        ],
    ]); ?>
    </div></div>
</div>
