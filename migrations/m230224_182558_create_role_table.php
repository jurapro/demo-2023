<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m230224_182558_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->unique()->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        $this->insert('{{%role}}', [
            'code' => 'user', 'name' => 'Зарегистрированный пользователь',
        ]);

        $this->insert('{{%role}}', [
            'code' => 'admin', 'name' => 'Администратор'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role}}');
    }
}
