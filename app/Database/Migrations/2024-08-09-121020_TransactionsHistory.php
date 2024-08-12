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
                'type'           => 'INT',
                'constraint'     => 100
            ],
            'plan_id' => [
                'type'           => 'INT',
                'constraint'     => 100
            ],
            'amount' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'paid_amount' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'status' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'hash' => [
                'type'       => 'VARCHAR',
                'constraint' => 225,
            ],
            'txid' => [
                'type'           => 'VARCHAR',
                'constraint'     => 225
            ],
            'date' => [
                'type'           => 'TIMESTAMP',
                'constraint'     => 'CURRENT_TIMESTAMP'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('transactions_history');
    }

    public function down()
    {
        $this->forge->dropTable('transactions_history');
    }
}
