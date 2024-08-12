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
                'auto_increment' => true,
            ],
            'unique_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '191',
                'null'       => true,
            ],
            'balance' => [
                'type'       => 'DECIMAL',
                'constraint' => '20,8',
                'default'    => '0.00000000',
            ],
            'cashouts' => [
                'type'       => 'DECIMAL',
                'constraint' => '20,8',
                'default'    => '0.00000000',
            ],
            'plan_id' => [
                'type' => 'INT',
                'null' => true,
            ],
            'reference_user_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'affiliate_earns' => [
                'type'       => 'FLOAT',
                'constraint' => '20,8',
                'default'    => '0.00000000',
                'null'       => false,
            ],
            'affiliate_paid' => [
                'type'       => 'FLOAT',
                'constraint' => '20,8',
                'default'    => '0.00000000',
                'null'       => false,
            ],
            'ip_addr' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null'       => false,
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'default'    => 'CURRENT_TIMESTAMP',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
