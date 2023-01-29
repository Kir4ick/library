<?php

namespace app\src\interfaces;

use yii\base\Model;

interface BookServiceInterface
{
    public function createBook(Model $request);
}
