<?php

namespace app\src\interfaces;

use yii\base\Model;

interface ReturnedServiceInterface
{
    public function createReturned(Model $request):Model|array;
}