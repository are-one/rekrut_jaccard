<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert as WidgetsAlert;
use frontend\assets\AppLoginAsset;
use yii\bootstrap4\Alert;
use yii\helpers\Html;

AppLoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="inner_page login">
    <?php $this->beginBody() ?>

    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <?= $content ?>

            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();