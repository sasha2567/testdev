<?php

use yii\db\Migration;

class m160815_113606_alter_table_user extends Migration
{
    public function up()
    {
        $this->dropColumn('alisjanskij_users', 'craeted_at');
        $this->addColumn('alisjanskij_users', 'created_at', $this->date());
    }

    public function down()
    {

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
