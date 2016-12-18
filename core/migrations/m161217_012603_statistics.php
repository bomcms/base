<?php

use yii\db\Migration;

class m161217_012603_statistics extends Migration
{
    public function up()
    {
        $this->createTable('statistics', [
            'id' => $this->primaryKey(),
            'sessions' => $this->string(),
            'date_log' => $this->timestamp(),
            'sources' => $this->string(),
            'ip' => $this->string(),
            'address' => $this->string(),
            'opera' => $this->string(),
            'browser' => $this->string(),
            'date_contact' => $this->timestamp()->null(),
            'full_name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string()->null(),
            'content' => $this->text()
        ]);

        $this->createIndex(
            'idx_sessions',
            'statistics',
            'sessions'
        );

    }

    public function down()
    {
        $this->dropTable('statistics');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
