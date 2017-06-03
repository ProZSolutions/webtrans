<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dbank */

//$this->title = $model->dbank_id;
$this->params['breadcrumbs'][] = ['label' => 'Driver', 'url' => ['driver/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dbank-view">
<style type="text/css">
    .summary
    {
        display:none;
    }
</style>
  <p><?= Html::a('Back',['driver/index'], ['class' => 'btn btn-warning']) ?></p>

     <?= GridView::widget([
        'dataProvider' => $model,
        
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

           //'dbank_id',
           // 'driver_id',
            'bank_name',
            'acc_no',
            'branch',
            'ifsc',
            // 'is_active',
            // 'user_id',
            // 'time',

            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Actions',
         'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => '{update} {delete}',

            
            ],
        ],
    ]); ?>

</div>
