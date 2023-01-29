<?php

namespace app\src\requests;

use yii\base\Model;

class BookCreateRequest extends Model
{
    public $title;
    public $author_name;

    public function rules()
    {
        return [
            [['title', 'author_name'], 'required'],
            ['title', 'string', 'min' => 1]
        ];
    }
}
