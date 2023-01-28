<?php

namespace app\api\controllers;

use yii\base\Model;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class BaseApiController extends ActiveController
{
    protected $noAuthActions = [];

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => [],
            ]
        ];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'optional' => array_merge($this->noAuthActions, ['options']),
        ];

        return $behaviors;
    }


    protected function validate(Model $model, array $params): Model|array
    {
        $model->load($params, '');
        if (!$model->validate()) {
            return $model->errors;
        }
        return $model;
    }
}
