<?php

namespace app\src\services;

use app\src\interfaces\ReturnedServiceInterface;
use app\src\models\Book;
use app\src\models\ReturnedList;
use app\src\models\TakenList;
use app\src\requests\ReturnedBookCreateRequest;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\HttpException;

class ReturnedService implements ReturnedServiceInterface
{

    /**
     * @param ReturnedBookCreateRequest $request
     * @return Model|array
     */
    public function createReturned(Model $request): Model|array
    {
        $taken = TakenList::findOne(['id' => $request->taken_id]);
        $transaction = ActiveRecord::getDb()->beginTransaction();
        $returned = new ReturnedList();
        $book = Book::findOne($taken->book_id);

        if($book->status === true){
            return ['message' => 'Книга уже возвращена'];
        }

        try {
            $returned = $returned->setBookId($taken->book_id)->setClientId($taken->client_id)
                ->setWorkerId(\Yii::$app->user->identity->getId())
                ->setDateReturned($request->date_returned)->setCondition($request->condition);
            $returned->save();


            $book->setStatus(true);
            $book->save();

            $transaction->commit();
        }catch (HttpException $e){
            $transaction->rollBack();
        }
        return $returned;
    }
}