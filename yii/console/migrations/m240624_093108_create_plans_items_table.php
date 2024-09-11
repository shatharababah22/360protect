<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plans_items}}`.
 */
class m240624_093108_create_plans_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%plans_items}}', [
            'id' => $this->primaryKey(),
            'insurance_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(), 
            'title_ar' => $this->text()->defaultValue(null),
        ]);

        $this->createIndex(
            'idx-plans_items-insurance_id',
            '{{%plans_items}}',
            'insurance_id'
        );

        
        $this->addForeignKey(
            'fk-plans_items-insurance_id',
            '{{%plans_items}}',
            'insurance_id',
            '{{%insurances}}',
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
            'fk-plans_items-insurance_id',
            '{{%plans_items}}'
        );

        $this->dropIndex(
            'idx-plans_items-insurance_id',
            '{{%plans_items}}'
        );

        $this->dropTable('{{%plans_items}}');
    }
}

