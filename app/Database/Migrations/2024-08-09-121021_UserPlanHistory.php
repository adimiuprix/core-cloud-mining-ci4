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
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'plan_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
            ],
            'last_sum' => [
                'type' => 'BIGINT',
            ],
            'expire_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('user_plan_history');
    }

    public function down()
    {
        $this->forge->dropTable('user_plan_history');
    }
}
