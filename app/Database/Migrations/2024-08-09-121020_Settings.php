<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
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
            'currency_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'currency_symbol' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'currency_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'wallet_min' => [
                'type'           => 'INT',
                'constraint'     => 10
            ],
            'wallet_max' => [
                'type'           => 'INT',
                'constraint'     => 100
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');

        $initialData = [
            [
                'currency_name'         => 'Troncoin',
                'currency_symbol'        => 'TRX',
                'currency_code'     => 'TRX',
                'wallet_min'           => '10',
                'wallet_max'      => '60',
            ],
        ];
        $this->db->table('settings')->insertBatch($initialData);
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
