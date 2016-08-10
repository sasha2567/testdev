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
    if (!Yii::$app->user->isGuest) {
        NavBar::begin([
            'brandLabel' => 'Application',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [
                ['label' => 'Home', 'url' => ['/payment/index']],
                ['label' => 'Payment', 'url' => ['/payment/index']],
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right login-logout'],
            'items' => [
            (Yii::$app->user->isGuest) ? (

                ['label' => 'Login', 'url' => ['/user/login']]

            ) : (
                '<li>'
                . Html::beginForm(['/user/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
            ],
        ]);
        NavBar::end();
    }
    else {
        $brandLabel = 'Welcome to Application.';
        switch(Yii::$app->controller->route) {
            case 'user/login':
                $brandLabel .= " Please Login";
                break;
            case 'user/registration':
                $brandLabel .= " Please Register";
                break;
        }
        NavBar::begin([
            'brandLabel' => $brandLabel,
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);
        NavBar::end();
    }
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
