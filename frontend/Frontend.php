<?php

namespace app\frontend;

use yii\base\BootstrapInterface;

/**
 * Frontend module definition class
 */
class Frontend extends \yii\base\Module implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\frontend\controllers';
    public $viewPath = 'app\frontend\views';

    /**
     * {@inheritdoc}
     */

    public function init()
{
    parent::init();
}

    public function bootstrap($app)
{
    $app->getUrlManager()->addRules([
        [
            'class' => 'yii\web\UrlRule',
            'pattern' => '/',
            'route' => $this->id.'/site/index'
        ]
    ]);
}
}
