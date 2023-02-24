<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m230224_184517_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'date' => $this->timestamp(),
            'name' => $this->string()->notNull(),
            'file' => $this->string()->null(),
            'count' => $this->integer()->defaultValue(0),
            'price' => $this->decimal()->defaultValue(0),
            'year' => $this->integer()->defaultValue(2023),
            'model' => $this->string()->null(),
            'country' => $this->string()->null(),
            'category_id' => $this->integer()->defaultValue(1),
        ]);
        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
        $this->insert('{{%product}}', [
            'name' => 'Принтер 1',
            'count' => 10,
        ]);
        $this->insert('{{%product}}', [
            'name' => 'Принтер 2',
            'count' => 5,
        ]);
        $this->insert('{{%product}}', [
            'name' => 'Принтер 3',
            'count' => 50,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
