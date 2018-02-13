<?php
namespace wardany\dform\assets ;

use yii\web\AssetBundle;

/**
 *
 * @author muhammad wardany <muhammad.wardany@gmail.com>
 */
class TagInputAsset extends AssetBundle{
    public $sourcePath = '@wardany/dform/web/tag_input';
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
    public $css = [
        'jquery.tag-editor.css',
    ];
    public $js = [
        'jquery.caret.min.js',
        'jquery.tag-editor.min.js',
        'init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
