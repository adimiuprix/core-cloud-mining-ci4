<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserWithdrawal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 100,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 100
            ],
            'type' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => 20,8,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['PENDING', 'PROCESSING', 'SUCCESS'],
                'default'  => 'PENDING'
            ],
            'tx' => [
                'type'       => 'VARCHAR',
                'constraint' => '191',
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'default'    => 'CURRENT_TIMESTAMP',
                'null'       => false,
                'on_update'  => 'CURRENT_TIMESTAMP',
            ],
            'date_paid' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_withdrawal');    }

    public function down()
    {
        $this->forge->dropTable('user_withdrawal');
    }
}
