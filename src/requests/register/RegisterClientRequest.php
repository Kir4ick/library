<?php

namespace app\src\requests\register;

class RegisterClientRequest extends MainRegisterRequest
{
    public $passport_series;
    public $passport_number;

    public function rules()
    {
        return array_merge(parent::rules(),
            [
                [['passport_series', 'passport_number'], 'required'],
                ['passport_series', 'match', 'pattern' => '/^[0-9]{4}$/', 'message' => 'Серия пасспорта дожна содержать 4 цифры'],
                ['passport_number', 'match', 'pattern' => '/^[0-9]{6}$/', 'message' => 'Номер пасспорта должен содержать 6 цифр']
            ]);
    }

}

