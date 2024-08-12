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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('plans');

        $initialData = [
            [
                'plan_name'         => 'Free',
                'is_default'        => '1',
                'point_per_day'     => '0.02000000',
                'version'           => 'Free',
                'earning_rate'      => '0.00091389',
                'price'             => '0.00000000',
                'duration'          => '0',
                'profit'            => '100',
            ],
            [
                'plan_name'         => 'Plan 1',
                'is_default'        => '0',
                'point_per_day'     => '0.10000000',
                'version'           => 'Plan 1',
                'earning_rate'      => '0.05091389',
                'price'             => '5.00000000',
                'duration'          => '10',
                'profit'            => '110',
            ],
            [
                'plan_name'         => 'Plan 2',
                'is_default'        => '0',
                'point_per_day'     => '0.10000000',
                'version'           => 'Plan 2',
                'earning_rate'      => '0.55099089',
                'price'             => '10.00000000',
                'duration'          => '10',
                'profit'            => '110',
            ],
            [
                'plan_name'         => 'Plan 3',
                'is_default'        => '0',
                'point_per_day'     => '0.10000000',
                'version'           => 'Plan 3',
                'earning_rate'      => '5.25091389',
                'price'             => '20.00000000',
                'duration'          => '20',
                'profit'            => '150',
            ],
        ];
        $this->db->table('plans')->insertBatch($initialData);
    }

    public function down()
    {
        $this->forge->dropTable('plans');
    }
}
