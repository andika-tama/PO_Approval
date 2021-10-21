<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPurchasing extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 7,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'date_needed' => [
                'type' => 'DATE',
            ],
            'pm_approved' => [
                'type' => 'ENUM("Approved","Declined", "Waiting")',
                'null' => true
            ],
            'gm_approved' => [
                'type' => 'ENUM("Approved","Declined", "Waiting")',
                'null' => true
            ],
            'cfo_approved' => [
                'type' => 'ENUM("Approved","Declined", "Waiting")',
                'null' => true
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'total_cost' => [
                'type' => 'INT',
                'constraint' => 20
            ],
            'status' => [
                'type' => 'ENUM("Approved","Declined", "Proccess")',
                'default' => 'Proccess',
                'null' => true
            ]

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('purchasing_list');
    }

    public function down()
    {
        $this->forge->dropTable('purchasing_list');
    }
}
