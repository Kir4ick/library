<?php

namespace app\api\interfaces;

use yii\base\Model;

interface RegisterServiceInterface
{
    public function registerClient(Model $request):array;
    public function registerWorker(Model $request):array;
}
