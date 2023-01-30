<?php

namespace app\api;

use app\api\v1\V1;
use app\src\interfaces\BookServiceInterface;
use app\src\interfaces\RegisterServiceInterface;
use app\src\interfaces\ReturnedServiceInterface;
use app\src\interfaces\TakenServiceInterface;
use app\src\services\BookService;
use app\src\services\RegisterSerivce;
use app\src\services\ReturnedService;
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
        \Yii::$container->set(ReturnedServiceInterface::class, ReturnedService::class);
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
        $app->urlManager->addRules(require __DIR__.'/config/rules.php');
    }
}
