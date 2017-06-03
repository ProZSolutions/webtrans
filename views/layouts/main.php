<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ProZ Solutions',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            // ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'About', 'url' => ['/site/about']],
             // ['label' => 'Bill List', 'url' => ['/bill-list/index']],
             //   ['label' => 'Card', 'url' => ['/card/index']],
             //    ['label' => 'Card Deposit', 'url' => ['/cdeposit/index']],
             
               // ['label' => 'Vendor', 'url' => ['/vendor/index']],
               // ['label' => 'Transport Bank', 'url' => ['/tbank/index']],
               [
                        'label'=>'Card', 
                        'url'=>'/card/index', 
                        'linkOptions '=> ['encode'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'],
                        'itemOptions '=> ['class'=>'dropdown'],
                        'submenuOptions '=> ['class'=>'dropdown-menu'],
                        'items'=>[
                        ['label'=>'Card', 'url'=>['/card/index']],
                               // ['label'=>'Bill List', 'url'=>['/bill-list/index']],
                                ['label'=>'Card Deposit', 'url'=>['/cdeposit/index']]
                        ]
                ],  ['label' => 'Driver', 'url' => ['/driver/index']],
                 ['label' => 'Bill List', 'url' => ['/bill-list/index']],
                ['label' => 'Trip', 'url' => ['/ltrip/index']],
             
               ['label' => 'Vehicle', 'url' => ['/vehicle/index']],
            [
                        'label'=>'Transport', 
                        'url'=>'/vendor/index', 
                        'linkOptions '=> [ 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'],
                        'itemOptions '=> ['class'=>'dropdown'],
                        'submenuOptions '=> ['class'=>'dropdown-menu'],
                        'items'=>[
                                ['label'=>'Transport', 'url'=>['/transport/index']],
                                ['label'=>'Transport Bank', 'url'=>['/tbank/index']],
                                  ['label'=>'vendor', 'url'=>['/vendor/index']],
                        ]
                ],
            //     ['label'=>'Vendor', 'url'=>['/vendor/index'],
                 
            // 'submenuOptions'=>['class'=>'nav-sub'],'items'=>[
            // ['label'=>'SubItem1', 'url'=>['site/anot','id'=>'12']],
            // ['label'=>'SubItem2', 'url'=>['site/anot','id'=>'13']],
      
            // ]],


               // ['label' => 'Dri', 'url' => ['/transport/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"> ProZ Solutions &copy; <?= date('Y') ?></p>

        <!-- <p class="pull-right"><?php //Yii::powered() ?></p> -->
        <p class="pull-right"><?php echo "";  ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
