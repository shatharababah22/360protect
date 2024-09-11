<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pricing}}`.
 */
class m240624_080646_create_pricing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pricing}}', [
            'id' => $this->primaryKey(),
            'plan_id' => $this->integer()->notNull(),
            'duration' => $this->integer()->notNull(),
            'passenger' => $this->string()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'discount_price' => $this->decimal(10, 2), 
            'status' => $this->boolean()->defaultValue(true), 
        ]);
        

     
        $this->createIndex(
            'idx-pricing-plan_id',
            '{{%pricing}}',
            'plan_id'
        );

        $this->addForeignKey(
            'fk-pricing-plan_id',
            '{{%pricing}}',
            'plan_id',
            '{{%plans}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      
        $this->dropForeignKey(
            'fk-pricing-plan_id',
            '{{%pricing}}'
        );

       
        $this->dropIndex(
            'idx-pricing-plan_id',
            '{{%pricing}}'
        );

        $this->dropTable('{{%pricing}}');
    }
}

