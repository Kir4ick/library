<?php

namespace app\src\services;

use app\src\interfaces\TakenServiceInterface;
use app\src\models\Book;
use app\src\models\Client;
use app\src\models\TakenList;
use app\src\requests\TakenBookCreateRequest;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\HttpException;

class TakenService implements TakenServiceInterface
{

    /**
     * @param TakenBookCreateRequest $request
     * @return TakenList|array
     */
    public function createTaken(Model $request)
    {
        $takenItem = new TakenList();
        $transaction = ActiveRecord::getDb()->beginTransaction();
        $book = Book::findOne(['id' => $request->book_id]);

        if($book->status == false){
            return ['message' => 'Книга уже отдана'];
        }

        try {
            $transaction->commit();
            //Можно было бы конечно сделать проверку на null,
            //Но в валидации уже есть такая проверка

            $worker_id = \Yii::$app->user->identity->getId();
            $client_id = Client::findOne(['id' => $request->client_id])->id;
            $takenItem = $takenItem->setWorkerId($worker_id)->setClientId($client_id)->setBookId($book->id)
                ->setDateTaken()->setTimeReturned($request->days);
            $takenItem->save();
            $book->status = false;
            $book->save();
        } catch (HttpException $e){
            $transaction->rollBack();
        }

        return $takenItem;
    }
}