<?php
/**
 * @author: Eugene
 * @date: 19.04.16
 * @time: 11:30
 */

namespace msdie\modules\comments\widgets\CommentsWidget\assets;


use yii\web\AssetBundle;

class CommentsWidgetAssets extends AssetBundle
{
    public $sourcePath = '@msdie/modules/comments/widgets/CommentsWidget/assets/assets';

//    public $css = [
//    ];

    public $js = [
        'js/script.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
}