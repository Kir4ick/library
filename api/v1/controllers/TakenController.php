<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiController;
use app\src\interfaces\TakenServiceInterface;
use app\src\models\TakenList;
use app\src\requests\TakenBookCreateRequest;

class TakenController extends BaseApiController
{
    public function __construct($id, $module,private TakenServiceInterface $takenService,$config = [])
    {
        parent::__construct($id, $module, $config);
    }

    protected $noAuthActions = ['create'];

    public function actionCreate(){
        /**
        $request = $this->validate(new TakenBookCreateRequest(), \Yii::$app->request->bodyParams);
        if(is_array($request)){
            return $request;
        }
         */
        $taken = (new TakenList())->setDateTaken()->setTimeReturned(7)->setBookId(1)
            ->setClientId(1)->setWorkerId(3);
        $taken->save();
        return $taken;
    }

    public function actionIndex(){

    }
}