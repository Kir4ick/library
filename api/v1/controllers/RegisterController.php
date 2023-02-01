<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiController;
use app\src\interfaces\RegisterServiceInterface;
use app\src\requests\register\RegisterClientRequest;
use app\src\requests\register\RegisterWorkerRequest;
use yii\filters\AccessControl;


class RegisterController extends BaseApiController
{
    private array $params;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['register-worker', 'register-client'],
            'rules' => [
                [
                    'allow'        => true,
                    'actions'      => ['register-worker'],
                    'roles'        => ['@'],
                    'matchCallback' => function(){
                        return \Yii::$app->user->identity->isAdmin();
                    }
                ],
                [
                    'allow'        => true,
                    'actions'      => ['register-client'],
                    'roles'        => ['@'],
                    'matchCallback' => function(){
                        return \Yii::$app->user->identity->isWorker();
                    }
                ],
            ]
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['update'], $actions['index'], $actions['delete'], $actions['create'], $actions['view']);
        return $actions;
    }

    public function __construct($id, $module, private RegisterServiceInterface $registerService,$config = [])
    {
        parent::__construct($id, $module, $config);
        $this->params = \Yii::$app->request->bodyParams;
    }

    public function actionRegisterClient(){
        $request = $this->validate(new RegisterClientRequest(), $this->params);
        if(is_array($request)){
            \Yii::$app->response->statusCode = 422;
            return ['message' => 'Ошибка валидации', 'data' => $request, 'code' => 422];
        }
        return $this->registerService->registerClient($request);
    }

    public function actionRegisterWorker(){
        $request = $this->validate(new RegisterWorkerRequest(), $this->params);
        if(is_array($request)){
            \Yii::$app->response->statusCode = 422;
            return ['message' => 'Ошибка валидации', 'data' => $request, 'code' => 422];
        }
        return $this->registerService->registerWorker($request);
    }

}
