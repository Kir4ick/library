<?php

namespace app\src\requests;

use app\src\models\Worker;
use yii\base\Model;

class LoginRequest extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'min' => 4, 'max' => 60],
            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword']
        ];
    }


    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $worker = Worker::findOne(['login' => $this->login]);
            if (!$worker || !$worker->validatePassword($this->password)) {
                $this->addError($attribute, 'Такого работника не существует');
            }
            \Yii::$app->user->setIdentity($worker);
        }
    }
}
