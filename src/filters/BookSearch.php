<?php

namespace app\src\filters;


use yii\db\ActiveQuery;

class BookSearch extends QueryFilter
{
    const TITLE = 'title';
    const STATUS = 'status';

    public function title(ActiveQuery $q, $value){
       $q->andWhere(['like', 'title', $value.'%', false]);
    }

    public function status(ActiveQuery $q, $value){
        $q->andWhere(['status' => (bool)$value]);
    }

    protected function getCallbacks():array
    {
        return [
            self::TITLE => [
                $this, 'title'
            ],
            self::STATUS => [
                $this, 'status'
            ]
        ];
    }
}
