<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VendorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-index col-sm-6">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [            
           'label'=>'Transport Name',
            'value' => 'transport.name',
            'headerOptions' => ['style' => 'color:#337ab7'],
            ],            
            'vendor_code',
            'verdor_corp',    
           

            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'template' => '{update} {delete}',

            'buttons' => [         

                'update' => function ($url, $model) {
                                 return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url , ['class' => 'update', 'data-pjax' => '0']);
                            },
            ],

            ],
        ],
    ]);
 $this->registerJs(
  "$(document).on('ready pjax:success', function() {  // 'pjax:success' use if you have used pjax
    $('.update').click(function(e){
       e.preventDefault();      
       $('#pModal').modal('show')
                  .find('.modal-content')
                  .load($(this).attr('href'));  

   });
   $('.closebutton').click(function(){
          
       $('#pModal').modal('hide')
                 

   });
});
");
  
 yii\bootstrap\Modal::begin([
    'id'=>'pModal',
   
]);

 yii\bootstrap\Modal::end();



     ?>
</div>
<div class="vendor-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
