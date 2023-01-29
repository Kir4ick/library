<?php

namespace app\src\filters;


use yii\db\ActiveQuery;

class BookSearch extends QueryFilter
{
    const TITLE = 'title';
    const ACTIVE = 'active';

    public function title(ActiveQuery $q, $value){
       $q->where(['like', 'title', $value.'%', false]);
    }

    protected function getCallbacks()
    {
        return [
            self::TITLE => [
                $this, 'title'
            ]
        ];
    }
}
