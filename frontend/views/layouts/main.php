<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
        'brandLabel' => 'Om~ Meditation',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Course', 'url' => ['/site/course']]
    ];
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Roster', 'url' => ['/site/roster']];
    }
    $menuItems[] = ['label' => 'About',
         'items' => [['label' => 'Contact', 'url' => ['/site/contact']],
                     ['label' => 'Donate Us', 'url' => ['/site/donation']]
                    ]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => Yii::$app->user->identity->firstName,
                        'items' => [
                            ['label' => 'Enrollment', 'url' => ['/user/all-enrollments']],
                            ['label' => 'Report', 'url' => ['/user/report']],
                            ['label' => 'Settings', 'url' => ['/user/view']],
                            '<li role="separator" class="divider"></li>',
                            '<li>'.Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton('Logout', ['class' => 'btn btn-link',
                                'style' => 'border-left-width: 10px'])
                            . Html::endForm() . '</li>']
                        ];
        /*
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->firstName . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
        */
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <?php if($this->context->id == 'user' ||
        ($this->context->action->id == 'view-roster' ||
         $this->context->action->id == 'roster')) : ?>
            <div class="row">

            <?= $content ?>
            </div>
    <?php else : ?>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    <?php endif; ?>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Om~ Meditation Centre <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
