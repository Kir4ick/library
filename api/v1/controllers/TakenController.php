<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiController;
use app\src\interfaces\TakenServiceInterface;

class TakenController extends BaseApiController
{
    public function __construct($id, $module,private TakenServiceInterface $takenService,$config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actionCreate(){

    }

    public function actionIndex(){

    }
}