<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m230126_154450_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'middle_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'passport_series' => $this->string(4)->notNull(),
            'passport_number' => $this->string(6)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-client-user_id',
            'client'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-client-user_id',
            'client'
        );
        $this->dropTable('{{%client}}');
    }
}
