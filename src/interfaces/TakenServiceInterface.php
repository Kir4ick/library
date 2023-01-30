<?php

namespace app\src\interfaces;

use yii\base\Model;

interface TakenServiceInterface
{
    public function createTaken(Model $request);

}