<?php
namespace wardany\dform\assets ;

use yii\web\AssetBundle;

/**
 *
 * @author muhammad wardany <muhammad.wardany@gmail.com>
 */
class DynamicFormBuilderAsset extends AssetBundle{
    public $sourcePath = '@wardany/dform/web';
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
    public $css = [
        'css/style.css',
        'css/panels.css',
        'https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css',
    ];
    public $js = [
        'js/settings.js',
        'https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
