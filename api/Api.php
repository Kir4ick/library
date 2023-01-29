<?php

namespace app\api;

use yii\base\BootstrapInterface;

/**
 * api module definition class
 */
class Api extends \yii\base\Module implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init(){
        parent::init();

        $this->modules = [
            'v1' => 'app\api\v1\V1'
        ];

        \Yii::$app->user->enableSession = false;
    }

    public function bootstrap($app)
    {
    $app->urlManager->addRules([
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'api/v1/register',
            ],
            'extraPatterns' => [
                'POST register-client' => 'register-client',
                'POST register-worker' => 'register-worker'
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'api/v1/position',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'api/v1/authorize',
            ],
            'extraPatterns' => [
                'POST authorize' => 'authorize',
                'GET me' => 'me',
                'GET logout' => 'logout'
            ]
        ]
    ]);
}
}
