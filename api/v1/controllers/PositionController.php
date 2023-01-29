<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiActiveController;
use app\api\models\Position;

class PositionController extends BaseApiActiveController
{
    public $modelClass = Position::class;

    protected $noAuthActions = ['index', 'create'];
}
