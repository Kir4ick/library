<?php

namespace app\src\interfaces;

use yii\base\Model;

interface ReturnedServiceInterface
{
    /**
     * @param Model $request
     * @return mixed
     */
    public function createReturned(Model $request);
}