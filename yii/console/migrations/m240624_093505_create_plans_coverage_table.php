<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plans_coverage}}`.
 */
class m240624_093505_create_plans_coverage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%plans_coverage}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'plan_id' => $this->integer()->notNull(),
            'YorN' => $this->string(10)->notNull(),
            'description' => $this->text()->notNull(),
        ]);

       
        $this->addForeignKey(
            'fk-plans_coverage-item_id',
            '{{%plans_coverage}}',
            'item_id',
            '{{%plans_items}}',
            'id',
            'CASCADE',
      
            
        );


        $this->addForeignKey(
            'fk-plans_coverage-plan_id',
            '{{%plans_coverage}}',
            'plan_id',
            '{{%plans}}',
            'id',
            'CASCADE',
      
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      
        $this->dropForeignKey('fk-plans_coverage-item_id', '{{%plans_coverage}}');
        $this->dropForeignKey('fk-plans_coverage-plan_id', '{{%plans_coverage}}');

       
        $this->dropTable('{{%plans_coverage}}');
    }
}

