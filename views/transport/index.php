<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transport-index col-sm-6">

    <h1><!--  //Html::encode($this->title)  --></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!--  <p>
        //Html::a('Create Transport', ['create'], ['class' => 'btn btn-success']) 
    </p> -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'name',
            'owner',


            ['class' => 'yii\grid\ActionColumn',
        'header'=>'Actions',
         'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => '{update} {delete}',

            'buttons' => [
            //'view' => function ($url, $model) {
                              //   return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url , ['class' => 'view', 'data-pjax' => '0']);
                          //  },

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
});
");
  $this->registerJs("$(document).on('ready pjax:success', function() {  // 'pjax:success' use if you have used pjax
    $('.closebutton').click(function(e){
          
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
<div class="transport-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
