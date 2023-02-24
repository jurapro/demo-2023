<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230224_183502_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'patronymic' => $this->string()->null(),
            'username' => $this->string()->unique()->notNull(),
            'email' => $this->string()->unique()->notNull(),
            'password' => $this->string()->notNull(),
            'role_id' => $this->integer()->defaultValue(1),
        ]);
        $this->createIndex(
            'idx-user-role_id',
            'user',
            'role_id'
        );
        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'role',
            'id',
            'CASCADE'
        );
        $this->insert('{{%user}}', [
            'name' => 'Иванов',
            'surname' => 'Иван',
            'patronymic' => 'Иванович',
            'username' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => md5('admin00'),
            'role_id' => 2,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
