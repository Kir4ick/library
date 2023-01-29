<?php

namespace app\api\v1\requests\register;

use app\api\models\Position;
use app\api\models\Worker;
use yii\base\Model;

class RegisterWorkerRequest extends MainRegisterRequest
{
    public $login;
    public $password;
    public $position_id;

    public function rules()
    {
        $rules =  array_merge(parent::rules(), [
            [['login', 'password', 'position_id'], 'required'],
            [['login', 'password'], 'string', 'min' => 6],
            ['login', 'unique', 'targetClass' => Worker::class],
            ['position_id', 'exist', 'targetClass' => Position::class, 'targetAttribute' => ['position_id' => 'id']]
        ]);
        return $rules;
    }
}
