<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiActiveController;
use app\src\models\Author;

class AuthorController extends BaseApiActiveController
{
    public $modelClass = Author::class;
}
