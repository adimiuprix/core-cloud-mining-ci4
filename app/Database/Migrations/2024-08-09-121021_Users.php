<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'unique_id'     => [
                'type'      => 'INT',
                'null'      => false,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '191',
                'null'       => false,
            ],
            'balance' => [
                'type'       => 'DECIMAL',
                'constraint' => '20,8',
                'default'    => '0.00000000',
                'null'       => false,
            ],
            'cashouts' => [
                'type'       => 'DECIMAL',
                'constraint' => '20,8',
                'default'    => '0.00000000',
                'null'       => false,
            ],
            'plan_id' => [
                'type'      => 'INT',
                'null'      => false,
            ],
            'ip_addr' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null'       => false,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
