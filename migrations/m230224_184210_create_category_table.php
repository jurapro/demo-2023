<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m230224_184210_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->insert('{{%category}}', [
            'name' => 'Лазерные принтеры',
        ]);

        $this->insert('{{%category}}', [
            'name' => 'Струйные принтеры',
        ]);

        $this->insert('{{%category}}', [
            'name' => 'Термопринтеры',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
