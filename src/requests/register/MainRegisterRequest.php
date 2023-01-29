<?php

namespace app\src\requests\register;

use yii\base\Model;

class MainRegisterRequest extends Model
{
    public $name;
    public $middle_name;
    public $last_name;

    public function rules()
    {
        return [
            [['name', 'middle_name', 'last_name'], 'required']
        ];
    }
}
