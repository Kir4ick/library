<?php

use yii\db\Migration;

/**
 * Class m230130_112121_create_workers
 */
class m230130_112121_create_workers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('position', [
            'name' => 'Администратор'
        ]);

        $this->insert('position', [
            'name' => 'Работник'
        ]);

        $this->insert('worker', [
               'login' => 'Admin',
               'password_hash' => Yii::$app->security->generatePasswordHash('Admin'),
               'name' => 'Админ',
               'middle_name' => 'Админович',
               'last_name' => 'Админов',
               'position_id' => 1
        ]);

        $this->insert('worker', [
                'login' => 'Kir4ick',
                'password_hash' => Yii::$app->security->generatePasswordHash('321zzz'),
                'name' => 'Кирилл',
                'middle_name' => 'Панькин',
                'last_name' => 'Юрьевич',
                'position_id' => 2
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230130_112121_create_workers cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230130_112121_create_workers cannot be reverted.\n";

        return false;
    }
    */
}
