<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%returned_list}}`.
 */
class m230129_164856_create_returned_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%returned_list}}', [
            'id' => $this->primaryKey(),
            'date_returned' => $this->dateTime(),
            'book_id' => $this->integer()->notNull(),
            'worker_id' => $this->integer()->notNull(),
            'client_id' => $this->integer()->notNull(),
            'condition' => $this->string()
        ]);

        $this->createIndex(
            'idx-returned_list-book_id',
            'returned_list',
            'book_id'
        );

        $this->addForeignKey(
            'fk-returned_list-book_id',
            'returned_list',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-returned_list-worker_id',
            'returned_list',
            'worker_id'
        );

        $this->addForeignKey(
            'fk-returned_list-worker_id',
            'returned_list',
            'worker_id',
            'worker',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-returned_list-client_id',
            'returned_list',
            'client_id'
        );

        $this->addForeignKey(
            'fk-returned_list-client_id',
            'returned_list',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%returned_list}}');
    }
}
