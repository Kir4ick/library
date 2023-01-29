<?php

namespace app\api\v1\controllers;

use app\api\controllers\BaseApiActiveController;
use app\src\filters\BookSearch;
use app\src\interfaces\BookServiceInterface;
use app\src\models\Book;
use app\src\requests\BookCreateRequest;

class BookController extends BaseApiActiveController
{
    protected $noAuthActions = ['index-books'];

    public $modelClass = Book::class;

    public function __construct($id, $module, private BookServiceInterface $bookService, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['index']);
        return $actions;
    }

    public function actionCreateBook(){
        $request = $this->validate(new BookCreateRequest(), \Yii::$app->request->bodyParams);
        if(is_array($request)){
            return $request;
        }
        return $this->bookService->createBook($request);
    }

    public function actionIndexBooks(){
        $books = Book::find();
        return (new BookSearch($_GET))->apply($books)->all();
    }

    public function actionIndexTest(){
        return ['asdasdads'];
    }
}
