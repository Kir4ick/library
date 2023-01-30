<?php

namespace app\src\requests;

use app\src\models\Client;
use app\src\models\TakenList;
use yii\base\Model;

class ReturnedBookCreateRequest extends Model
{
    public $taken_id;
    public $condition;
    public $date_returned;

    public function rules()
    {
        return [
            [['taken_id', 'condition'], 'required'],
            [['taken_id'], 'exist', 'skipOnError' => true, 'targetClass' => TakenList::class, 'targetAttribute' => ['taken_id' => 'id']]
        ];
    }
}