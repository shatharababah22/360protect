<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%upload}}`.
 */
class m240628_234717_create_upload_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%upload}}', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string()->notNull(),
         
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%upload}}');
    }
}
