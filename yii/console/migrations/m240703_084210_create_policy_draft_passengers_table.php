<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%policy_draft_passengers}}`.
 */
class m240703_084210_create_policy_draft_passengers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%policy_draft_passengers}}', [
            'id' => $this->primaryKey(),
            'draft_id' => $this->integer()->notNull(),
            'first_name' => $this->string(100)->notNull(),
            'middle_name' => $this->string(255),
            'last_name' => $this->string(100)->notNull(),
            'gender' => $this->string(10)->notNull(),
            'nationality' => $this->string(100)->notNull(),
            'id_type' => $this->string(50)->notNull(),
            'id_number' => $this->string(100)->notNull(),
            'dob' =>  $this->date()->notNull(),
            'country' => $this->string(100)->notNull(),
            'city' => $this->string(100),
            'warning' => $this->text(),
            'document_link' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

       
        $this->addForeignKey(
            'fk-policy_draft_passengers-draft_id',
            '{{%policy_draft_passengers}}',
            'draft_id',
            '{{%policy_draft}}',
            'id',
            'CASCADE'
        );

     
        $this->createIndex(
            'idx-policy_draft_passengers-draft_id',
            '{{%policy_draft_passengers}}',
            'draft_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Drop index
        $this->dropIndex(
            'idx-policy_draft_passengers-draft_id',
            '{{%policy_draft_passengers}}'
        );

        // Drop foreign key
        $this->dropForeignKey(
            'fk-policy_draft_passengers-draft_id',
            '{{%policy_draft_passengers}}'
        );

        // Drop table
        $this->dropTable('{{%policy_draft_passengers}}');
    }
}