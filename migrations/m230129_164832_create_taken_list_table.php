<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%taken_list}}`.
 */
class m230129_164832_create_taken_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('book', 'status', 'boolean');

        $this->createTable('{{%taken_list}}', [
            'id' => $this->primaryKey(),
            'date_taken' => $this->dateTime(),
            'book_id' => $this->integer()->notNull(),
            'worker_id' => $this->integer()->notNull(),
            'client_id' => $this->integer()->notNull(),
            'time' => $this->integer()
        ]);

        $this->createIndex(
            'idx-taken_list-book_id',
            'taken_list',
            'book_id'
        );

        $this->addForeignKey(
            'fk-taken_list-book_id',
            'taken_list',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-taken_list-worker_id',
            'taken_list',
            'worker_id'
        );

        $this->addForeignKey(
            'fk-taken_list-worker_id',
            'taken_list',
            'worker_id',
            'worker',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-taken_list-client_id',
            'taken_list',
            'client_id'
        );

        $this->addForeignKey(
            'fk-taken_list-client_id',
            'taken_list',
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
        $this->dropTable('{{%taken_list}}');
    }
}
