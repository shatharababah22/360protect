<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%countries}}`.
 */
class m240623_113111_create_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%countries}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(2)->notNull()->defaultValue(''),
            'mobile_ex' => $this->string(20)->notNull(),
            'call_key' => $this->string(5)->notNull(),
            'name_en' => $this->string(100)->notNull()->defaultValue(''),
            'name_ar' => $this->string(100)->notNull(),
            'active_orders' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'sort' => $this->integer(3)->notNull(),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%countries}}');
    }
}

