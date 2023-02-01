<?php

namespace app\api\controllers;

use yii\base\Model;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class BaseApiActiveController extends ActiveController
{
    protected $noAuthActions = [];

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

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