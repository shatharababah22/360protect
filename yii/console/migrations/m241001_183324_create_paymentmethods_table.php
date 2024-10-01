<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%paymentmethods}}`.
 */
class m241001_183324_create_paymentmethods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%paymentmethods}}', [
            'id' => $this->primaryKey(),
            'method'=>$this->string()->defaultValue(null),
            'customer_id' => $this->integer()->notNull(),
            'response'=>$this->string()->defaultValue(null),

        ]);

        $this->createIndex(
            '{{%idx-paymentmethods-customer_id}}',
            '{{%paymentmethods}}',
            'customer_id'
        );

   
        $this->addForeignKey(
            '{{%fk-paymentmethods-customer_id}}',
            '{{%paymentmethods}}',
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

      
        $this->dropIndex(
            '{{%idx-policy-customer_id}}',
            '{{%policy}}'
        );

        $this->dropTable('{{%paymentmethods}}');
    }
}
