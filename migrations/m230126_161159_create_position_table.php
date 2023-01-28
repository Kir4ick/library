<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%position}}`.
 */
class m230126_161159_create_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%position}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);

        $this->createIndex(
            'idx-worker-position_id',
            'worker',
            'position_id'
        );

        $this->addForeignKey(
            'fk-worker-position_id',
            'worker',
            'position_id',
            'position',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%position}}');
    }
}
