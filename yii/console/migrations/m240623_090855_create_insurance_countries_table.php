<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%insurance_countries}}`.
 */
class m240623_090855_create_insurance_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%insurance_countries}}', [
            'id' => $this->primaryKey(),
            'insurance_id' => $this->integer()->notNull(),
            'country_code' => $this->string(100)->notNull(),
            'company_name' => $this->string(255)->notNull(),
            'company_logo' => $this->string()->notNull(),
            'source_country' => $this->string(255)->notNull(),
            'source_country_ar' => $this->string()->defaultValue(null),
            'source_country_code' => $this->string(100)->notNull(),
            'slug' => $this->string()->notNull(),

        ]);

        
        $this->createIndex(
            '{{%idx-insurance_countries-insurance_id}}',
            '{{%insurance_countries}}',
            'insurance_id'
        );

       
        $this->addForeignKey(
            '{{%fk-insurance_countries-insurance_id}}',
            '{{%insurance_countries}}',
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
            '{{%fk-insurance_countries-insurance_id}}',
            '{{%insurance_countries}}'
        );

     
        $this->dropIndex(
            '{{%idx-insurance_countries-insurance_id}}',
            '{{%insurance_countries}}'
        );

        $this->dropTable('{{%insurance_countries}}');
    }
}