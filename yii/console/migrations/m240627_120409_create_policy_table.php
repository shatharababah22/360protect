<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%policy}}`.
 */
class m240627_120409_create_policy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%policy}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull(),
            'from_airport' => $this->string(100)->notNull(),
            'DepartCountryCode' => $this->string(11)->null(),
            'departure_date' => $this->date()->notNull(),
            'going_to' => $this->string(100)->notNull(),
            'ArrivalCountryCode' => $this->string(11)->null(),
            'return_date' => $this->date()->notNull(),
            'ProposalState' => $this->string(100)->null(),
            'ItineraryID' => $this->string(255)->null(),
            'PNR' => $this->string(200)->null(),
            'PolicyNo' => $this->string(200)->null(),
            'PolicyPurchasedDateTime' =>$this->date()->notNull(),
            'PolicyURLLink' => $this->text()->null(),
            'status' => $this->integer()->notNull(),
            'status_description' => $this->text()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'source' => $this->integer()->null(),
            'price' => $this->decimal(10, 2)->null(),
        ]);

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-policy-customer_id}}',
            '{{%policy}}',
            'customer_id'
        );

   
        $this->addForeignKey(
            '{{%fk-policy-customer_id}}',
            '{{%policy}}',
            'customer_id',
            '{{%customers}}',
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
            '{{%fk-policy-customer_id}}',
            '{{%policy}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-policy-customer_id}}',
            '{{%policy}}'
        );

        $this->dropTable('{{%policy}}');
    }
}
