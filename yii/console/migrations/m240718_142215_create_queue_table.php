<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%queue}}`.
 */
class m240718_142215_create_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%queue}}', [
            'id' => $this->bigPrimaryKey(),
            'channel' => $this->string()->notNull(),
            'job' => $this->binary()->notNull(),
            'pushed_at' => $this->integer()->notNull(),
            'ttr' => $this->integer()->notNull(),
            'delay' => $this->integer()->notNull(),
            'priority' => $this->integer()->defaultValue(1024),
            'reserved_at' => $this->integer()->defaultValue(null),
            'attempt' => $this->integer()->defaultValue(null),
            'done_at' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex('idx-queue-channel', '{{%queue}}', 'channel');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%queue}}');
    }
}
