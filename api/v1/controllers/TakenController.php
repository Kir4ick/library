<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiActiveController;
use app\src\interfaces\TakenServiceInterface;
use app\src\models\TakenList;
use app\src\requests\TakenBookCreateRequest;

class TakenController extends BaseApiActiveController
{
    public function __construct($id, $module,private TakenServiceInterface $takenService,$config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public $modelClass = TakenList::class;

    public function actionCreate(){

        $request = $this->validate(new TakenBookCreateRequest(), \Yii::$app->request->bodyParams);
        if(is_array($request)){
            return $request;
        }
        return $this->takenService->createTaken($request);
    }

}