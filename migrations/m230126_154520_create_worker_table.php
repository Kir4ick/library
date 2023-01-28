<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%worker}}`.
 */
class m230126_154520_create_worker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%worker}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->unique()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'name' => $this->string()->notNull(),
            'middle_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'position_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%worker}}');
    }
}
