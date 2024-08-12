<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserPlanHistory extends Migration
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
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'  => 'active'
            ],
            'last_sum' => [
                'type'           => 'BIGINT',
            ],
            'expire_date' => [
                'type'           => 'DATE',
                'null'     => true
            ],
            'created_at' => [
                'type'       => 'DATE',
                'constraint' => 'CURRENT_TIMESTAMP',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_plan_history');
    }

    public function down()
    {
        $this->forge->dropTable('user_plan_history');
    }
}
