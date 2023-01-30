<?php

namespace app\src\requests;

use app\src\models\Book;
use app\src\models\Client;
use app\src\models\Worker;
use yii\base\Model;

class TakenBookCreateRequest extends Model
{
    public $book_name;
    public $client_middle_name;
    public $days;

    public function rules()
    {
        return [
            [['book_name', 'client_middle_name', 'days'], 'required'],
            [['book_name'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_name' => 'title']],
            [['client_middle_name'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_middle_name' => 'middle_name']],
            ['days', 'integer']
        ];
    }
}