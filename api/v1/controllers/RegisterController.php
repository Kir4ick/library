<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiController;

/**
 * Default controller for the `v1` module
 */
class RegisterController extends BaseApiController
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actionRegisterClient(){

    }

    public function actionRegisterWorker(){}

}
