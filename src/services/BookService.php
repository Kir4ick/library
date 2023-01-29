<?php

namespace app\src\services;

use app\src\interfaces\BookServiceInterface;
use app\src\models\Author;
use app\src\models\Book;
use app\src\requests\BookCreateRequest;
use yii\base\Model;
use yii\db\ActiveRecord;

class BookService implements BookServiceInterface
{

    /**
     * @param BookCreateRequest $request
     * @return Book|array
     */
    public function createBook(Model $request):Book|array
    {
        $transaction = ActiveRecord::getDb()->beginTransaction();
        $book = new Book();
        try {

            $book = $book->setTitle($request->title)
                ->setArticle()->setDateReceipt()->setStatus();
            $book->save();

            if(is_array($request->author_name)){

                foreach ($request->author_name as $name){
                    $book->link('authors', $this->createOrGetAuthor($name));
                }

            }else{
                $book->link('authors', $this->createOrGetAuthor($request->author_name));
            }

            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            return ['message' => 'Не удалось добавить книгу', $book->errors];
        }
        return $book;
    }

    private function createOrGetAuthor($name){
        $author = Author::findOne(['name' => $name]);


        if($author === null){

            $author = new Author();
            $author->name = $name;

            $author->save();

        }

        return $author;
    }
}
