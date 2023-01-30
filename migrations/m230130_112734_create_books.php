<?php

use yii\db\Migration;

/**
 * Class m230130_112734_create_books
 */
class m230130_112734_create_books extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 40; $i++){
            $author = new \app\src\models\Author();
            $author->name = $faker->name();
            $author->save(false);
        }

        for ($i = 0; $i < 40; $i++){
            $book = new \app\src\models\Book();
            $book = $book->setArticle(Yii::$app->security->generateRandomString(30))
                ->setTitle($faker->text(10))->setDateReceipt()->setStatus((bool)rand(0,1));
            $book->save(false);
        }

        for ($i = 0; $i < 40; $i++){
            $this->insert('book_author', [
               'book_id' => rand(1,40),
                'author_id' => rand(1,40)
            ]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230130_112734_create_books cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230130_112734_create_books cannot be reverted.\n";

        return false;
    }
    */
}
