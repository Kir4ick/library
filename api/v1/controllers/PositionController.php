<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiActiveController;
use app\src\models\Position;
use yii\filters\AccessControl;

class PositionController extends BaseApiActiveController
{
    public $modelClass = Position::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['register-worker', 'register-client'],
            'rules' => [
                [
                    'allow'        => true,
                    'actions'      => ['index', 'create', 'update', 'view', 'delete'],
                    'roles'        => ['@'],
                    'matchCallback' => function(){
                        return \Yii::$app->user->identity->isAdmin();
                    }
                ]
            ]
        ];
        return $behaviors;
    }
}
