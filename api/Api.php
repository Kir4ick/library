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
                'api/v1/position', 'api/v1/author', 'api/v1/authorize', 'api/v1/register', 'api/v1/book',
            ],
            'extraPatterns' => [
                'POST ' => 'authorize',
                'GET me' => 'me',
                'GET logout' => 'logout',
                'POST register-client' => 'register-client',
                'POST register-worker' => 'register-worker',
                'POST create' => 'create-book',
                'GET ' => 'index-books',
            ]
        ],

    ]);
}
}
