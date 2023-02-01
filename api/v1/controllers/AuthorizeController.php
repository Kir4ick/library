<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiController;
use app\src\requests\LoginRequest;

class AuthorizeController extends BaseApiController
{
    protected $noAuthActions = ['authorize'];

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['update'], $actions['index'], $actions['delete'], $actions['create'], $actions['view']);
        return $actions;
    }

    public function actionAuthorize(){
        $request = $this->validate(new LoginRequest(), \Yii::$app->request->bodyParams);
        if(is_array($request)){
            \Yii::$app->response->statusCode = 422;
            return ['message' => 'Ошибка валидации', 'data' => $request, 'code' => 422];
        }

        $token = \Yii::$app->user->identity->getAuthKey();
        return ['token' => $token];
    }

    public function actionMe(){
        return \Yii::$app->user->identity;
    }

    public function actionLogout(){
        \Yii::$app->user->identity->removeAuthKey();
        return ['message' => 'Вы успешно вышли из аккаунта'];
    }

}
