<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppLoginAsset extends AssetBundle
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
        // 'template/js/perfect-scrollbar.min.js',
        // 'template/js/custom2.js',
        // 'template/js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}