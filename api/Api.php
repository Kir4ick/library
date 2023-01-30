<?php

namespace app\api;

use app\api\v1\V1;
use app\src\interfaces\BookServiceInterface;
use app\src\interfaces\RegisterServiceInterface;
use app\src\interfaces\TakenServiceInterface;
use app\src\services\BookService;
use app\src\services\RegisterSerivce;
use app\src\services\TakenService;
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


    private function setDependency(){
        \Yii::$container->set(BookServiceInterface::class, BookService::class);
        \Yii::$container->set(RegisterServiceInterface::class, RegisterSerivce::class);
        \Yii::$container->set(TakenServiceInterface::class, TakenService::class);
    }
    /**
     * {@inheritdoc}
     */
    public function init(){
        parent::init();

        $this->setDependency();
        \Yii::$app->user->enableSession = false;

        $this->modules = [
            'v1' => V1::class
        ];
    }

    public function bootstrap($app)
    {
    $app->urlManager->addRules([
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'api/v1/position', 'api/v1/author', 'api/v1/book',
            ],
            'extraPatterns' => [
                'POST create' => 'create-book',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'api/v1/authorize',
            ],
            'extraPatterns' => [
                'POST ' => 'authorize',
                'GET me' => 'me',
                'GET logout' => 'logout',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'api/v1/register',
            ],
            'extraPatterns' => [
                'POST client' => 'register-client',
                'POST worker' => 'register-worker',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'api/v1/taken',
            ],
            'extraPatterns' => [
                'POST ' => 'create',
            ]
        ],
    ]);
    }
}
