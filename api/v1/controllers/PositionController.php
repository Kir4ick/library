<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiActiveController;
use app\src\models\Position;

class PositionController extends BaseApiActiveController
{
    public $modelClass = Position::class;
}
