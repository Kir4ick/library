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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%returned_list}}');
    }
}
