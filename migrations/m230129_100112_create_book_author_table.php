<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m230129_100112_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author}}', [
            'book_id' => $this->integer(),
            'author_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-book_author-book_id',
            'book_author',
            'book_id'
        );

        $this->addForeignKey(
            'fk-book_author-book_id',
            'book_author',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-book_author-author_id',
            'book_author',
            'author_id'
        );

        $this->addForeignKey(
            'fk-book_author-author_id',
            'book_author',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_author}}');
    }
}
