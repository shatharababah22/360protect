<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%insurances}}`.
 */
class m240620_173336_create_insurances_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%insurances}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'overview' => $this->text()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'name_ar' => $this->string()->defaultValue(null),
            'overview_ar' => $this->string()->defaultValue(null),
            'description_ar' => $this->string()->defaultValue(null),
            'photo' => $this->string()->defaultValue(null),
            'price' => $this->integer()->notNull(),
            'benefits_link' => $this->string()->defaultValue(null),
            'slug' => $this->string()->unique()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%insurances}}');
    }
}
