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
            'time' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%taken_list}}');
    }
}
