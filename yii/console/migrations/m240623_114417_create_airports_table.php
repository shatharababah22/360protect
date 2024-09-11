<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%airports}}`.
 */
class m240623_114417_create_airports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%airports}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50),
            'name' => $this->string(200),
            'cityCode' => $this->string(50),
            'cityName' => $this->string(200),
            'countryName' => $this->string(200),
            'countryCode' => $this->string(200),

          
            
        ]);

  

      
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       

        $this->dropTable('{{%airports}}');
    }
   
}
