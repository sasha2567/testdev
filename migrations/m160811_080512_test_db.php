<?php

use yii\db\Migration;
use \yii\db\pgsql\Schema;

class m160811_080512_test_db extends Migration
{
    public function up()
    {
        //$this->dropTable('alisjanskij_users');

        //$this->dropTable('alisjanskij_payments');

        $this->createTable('alisjanskij_users', [
            'user_id' => 'BIGSERIAL PRIMARY KEY',// . ' DEFAULT NEXTVAL(\'user_id_seq\')',
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->text()->notNull(),
            'created_at' => $this->date()->notNull(),
        ]);

        $this->createTable('alisjanskij_payments', [
            'payment_id' => 'BIGSERIAL PRIMARY KEY',// . ' DEFAULT NEXTVAL(\'payment_id_seq\')',
            'starts_at' => $this->date()->notNull(),
            'ends_at' => $this->date()->notNull(),
            'user_userid' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user-payment_id',
            'alisjanskij_payments',
            'user_userid',
            'alisjanskij_users',
            'user_id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'ffk-user-payment_id',
            'alisjanskij_payments'
        );

        $this->dropTable('alisjanskij_users');

        $this->dropTable('alisjanskij_payments');
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
