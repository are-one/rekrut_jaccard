<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>User-index</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="inner_page project_page">
    <?php $this->beginBody() ?>

    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <?= $this->render('@app/views/layouts/app-bar/sidebar') ?>
            <!-- end sidebar -->

            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <?= $this->render("app-bar/topbar") ?>
                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <!-- Header title -->
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Slamat Datang Calon Pelamar Baru</h2>
                                </div>
                            </div>
                        </div>

                        <?= Alert::widget() ?>

                        <!-- row -->
                        <div class="row column1">
                            <div class="col-md-12">

                                <?= $content ?>

                            </div>
                            <!-- end row -->
                        </div>

                        <!-- footer -->
                        <?= $this->render("footer") ?>

                    </div>
                    <!-- end dashboard inner -->
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();