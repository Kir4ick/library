<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiActiveController;
use app\src\models\Position;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class PositionController extends BaseApiActiveController
{
    public $modelClass = Position::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['index', 'view', 'create', 'update', 'delete'],
            'rules' => [
                [
                    'allow'        => true,
                    'actions'      => ['index', 'create', 'update', 'view', 'delete'],
                    'roles'        => ['@'],
                    'matchCallback' => function(){
                        return \Yii::$app->user->identity->isAdmin();
                    }
                ]
            ],
            'denyCallback' => function($rule, $action){
                throw new ForbiddenHttpException('Доступ запрещён', 403);
            }
        ];
        return $behaviors;
    }
}
