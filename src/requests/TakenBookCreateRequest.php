<?php

namespace app\src\requests;

use app\src\models\Book;
use app\src\models\Client;
use app\src\models\Worker;
use yii\base\Model;

class TakenBookCreateRequest extends Model
{
    public $book_id;
    public $client_id;
    public $days;

    public function rules()
    {
        return [
            [['book_id', 'client_id', 'days'], 'required'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
            ['days', 'integer']
        ];
    }
}