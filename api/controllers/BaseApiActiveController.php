<?php

namespace app\api\controllers;

use yii\filters\auth\HttpBearerAuth;

class BaseApiActiveController
{
    protected $noAuthActions = [];

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'optional' => array_merge($this->noAuthActions, ['options']),
        ];

        return $behaviors;
    }
}
