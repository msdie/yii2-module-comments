<?php

namespace msdie\modules\comments;

/**
 * comments module definition class
 */
class Module extends \yii\base\Module
{
    public $fields;
    public $userClass;
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'msdie\modules\comments\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        \Yii::configure($this, require($this->basePath.'/config/config.php'));
    }
}
