<?php

namespace app\api\v1\controllers;

use app\src\interfaces\ReturnedServiceInterface;
use app\src\models\ReturnedList;
use app\src\requests\ReturnedBookCreateRequest;

class ReturnedController extends \app\api\controllers\BaseApiActiveController
{

    public function __construct($id, $module, private ReturnedServiceInterface $returnedService,$config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'],$actions['delete'], $actions['update']);
        return $actions;
    }

    public $modelClass = ReturnedList::class;

    public function actionCreate(){
        $request = $this->validate(new ReturnedBookCreateRequest(), \Yii::$app->request->bodyParams);
        if(is_array($request)){
            \Yii::$app->response->statusCode = 422;
            return ['message' => 'Ошибка валидации', 'data' => $request, 'code' => 422];;
        }
        return $this->returnedService->createReturned($request);
    }
}