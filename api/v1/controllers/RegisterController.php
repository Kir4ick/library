<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiController;
use app\api\models\Client;
use app\api\v1\requests\register\RegisterClientRequest;
use app\api\v1\requests\register\RegisterWorkerRequest;
use app\api\v1\services\RegisterSerivce;

/**
 * Default controller for the `v1` module
 */
class RegisterController extends BaseApiController
{
    private array $params;
    public $modelClass = Client::class;

    protected $noAuthActions = ['register-client', 'register-worker'];

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['update'], $actions['index'], $actions['delete'], $actions['create'], $actions['view']);
        return $actions;
    }

    public function __construct($id, $module, private RegisterSerivce $registerService,$config = [])
    {
        parent::__construct($id, $module, $config);
        $this->params = \Yii::$app->request->bodyParams;
    }

    public function actionRegisterClient(){
        $request = $this->validate(new RegisterClientRequest(), $this->params);
        if(is_array($request)){
            return $request;
        }
        return $this->registerService->registerClient($request);
    }

    public function actionRegisterWorker(){
        $request = $this->validate(new RegisterWorkerRequest(), $this->params);
        if(is_array($request)){
            return $request;
        }
        return $this->registerService->registerWorker($request);
    }

}
