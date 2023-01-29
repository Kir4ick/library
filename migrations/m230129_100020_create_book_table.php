<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m230129_100020_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'article' => $this->string()->unique()->notNull(),
            'date_receipt' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-book-article',
            'book',
            'article'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
