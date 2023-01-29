<?php

namespace app\src\requests\register;

use app\src\models\Position;
use app\src\models\Worker;

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
