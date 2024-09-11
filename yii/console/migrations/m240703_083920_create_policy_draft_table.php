<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%policy_draft}}`.
 */
class m240703_083920_create_policy_draft_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%policy_draft}}', [
            'id' => $this->primaryKey(),
            'insurance_id' => $this->integer()->notNull(),
            'plan_id' => $this->integer()->notNull(),
            'email' => $this->string(255),
            'name' => $this->string(255),
            'mobile' => $this->string(255),
            'from_airport' => $this->string(100),
            'DepartCountryCode' => $this->string(11),
            'departure_date' => $this->date()->notNull(),
            'going_to' => $this->string(100),
            'ArrivalCountryCode' => $this->string(11),
            'return_date' => $this->date()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'source' => $this->string(100),
            'price' => $this->decimal(10, 2),
            'adult' => $this->integer(),
            'children' => $this->integer(),
            'infant' => $this->integer(),
            'AdultCount' => $this->integer(),
            'ChildrenCount' => $this->integer(),
            'InfantCount' => $this->integer(),
        ]);

        
        $this->addForeignKey(
            'fk-policy_draft-insurance_id',
            '{{%policy_draft}}',
            'insurance_id',
            '{{%insurances}}',
            'id',
            'CASCADE'
        );

       
        $this->addForeignKey(
            'fk-policy_draft-plan_id',
            '{{%policy_draft}}',
            'plan_id',
            '{{%plans}}',
            'id',
            'CASCADE'
        );

     
        $this->createIndex(
            'idx-policy_draft-insurance_id',
            '{{%policy_draft}}',
            'insurance_id'
        );

        $this->createIndex(
            'idx-policy_draft-plan_id',
            '{{%policy_draft}}',
            'plan_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Drop indexes
        $this->dropIndex(
            'idx-policy_draft-insurance_id',
            '{{%policy_draft}}'
        );

        $this->dropIndex(
            'idx-policy_draft-plan_id',
            '{{%policy_draft}}'
        );

        // Drop foreign keys
        $this->dropForeignKey(
            'fk-policy_draft-insurance_id',
            '{{%policy_draft}}'
        );

        $this->dropForeignKey(
            'fk-policy_draft-plan_id',
            '{{%policy_draft}}'
        );

        // Drop table
        $this->dropTable('{{%policy_draft}}');
    }
}
