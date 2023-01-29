<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiController;
use app\api\models\Position;

class PositionController extends BaseApiController
{
    public $modelClass = Position::class;

    protected $noAuthActions = ['index', 'create'];
}
