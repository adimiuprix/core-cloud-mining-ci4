<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Plans extends Migration
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
            'plan_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'is_default' => [
                'type'           => 'TINYINT',
                'constraint'     => 1
            ],
            'point_per_day' => [
                'type'       => 'DECIMAL',
                'constraint' => 20,8,
            ],
            'version' => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'earning_rate' => [
                'type'           => 'DECIMAL',
                'constraint'     => 20,8
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => 20,8,
            ],
            'duration' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'profit' => [
                'type'           => 'DECIMAL',
                'constraint'     => 20,8
            ],
            'speed' => [
                'type'       => 'INT',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('plans');
    }

    public function down()
    {
        $this->forge->dropTable('plans');
    }
}
