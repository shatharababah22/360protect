<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customers}}`.
 */
class m240627_112938_create_customers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customers}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'name' => $this->string()->defaultValue(null),
            'mobile' => $this->string()->notNull(),
            'country' => $this->string()->defaultValue(null),
            'credit' => $this->decimal(10, 2)->defaultValue(0), 
          
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customers}}');
    }
}
