<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransactionsHistory extends Migration
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
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'plan_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '20,8',
                'default'    => '0.00000000',
            ],
            'paid_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '20,8',
                'default'    => '0.00000000',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'hash' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
                'null'       => false,
            ],
            'txid' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
                'null'       => false,
            ],
            'date DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('transactions_history');
    }

    public function down()
    {
        $this->forge->dropTable('transactions_history');
    }
}
