<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'template/css/bootstrap.min.css',
        'template/style.css',
        'template/css/responsive.css',
        'template/css/colors.css',
        'template/css/bootstrap-select.css',
        'template/css/perfect-scrollbar.css',
        'template/css/custom.css',
        'template/js/semantic.min.css',
    ];
    public $js = [
        'template/js/jquery.min.js',
        'template/js/popper.min.js',
        'template/js/bootstrap.min.js',
        'template/js/animate.js',
        'template/js/bootstrap-select.js',
        'template/js/owl.carousel.js', 
        'template/js/Chart.min.js',
        'template/js/Chart.bundle.min.js',
        'template/js/utils.js',
        'template/js/analyser.js',
        'template/js/perfect-scrollbar.min.js',
        'template/js/custom2.js',
        'template/js/custom.js',
        'template/js/chart_custom_style1.js',
        'template/js/semantic.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapAsset',
    ];
}